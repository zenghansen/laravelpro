<?php

namespace App\Http\Controllers\Jg;


use App\Models\Jg\CustomerModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use lib\common\Ateset;
use App\Http\Controllers\Controller;
use lib\common\Tool;

class CustomerController extends Controller
{
    public function __construct()
    {
        view()->share('getUrl', '/admin/jg/customer/list');
        view()->share('editUrl', '/admin/jg/customer/edit');
    }

    public function showLogin()
    {
        $jsList = [''];
        return view('user.login');
    }

    public function tpl()
    {
        $jsList = ['js/jg/customer/index.js'];
        return view('jg/customer.index', ['jsList' => $jsList]);
    }

    public function getList(Request $request)
    {
        $pageSize = $request->rows;

        $user = Auth::user();
        if ($user->roleId == 1) {
            $user = CustomerModel::where("isDel", '=', '0')->paginate($pageSize)->toArray();
        } else {
            $adminId = $user->id;
            $user = CustomerModel::where("isDel", 0)->where('adminId', $adminId)->paginate($pageSize)->toArray();
        }


        $adminIds = array_column($user['data'], 'adminId');
        $admin = User::whereIn('id', $adminIds)->select(['name', 'id'])->get()->toArray();
        $list = Tool::setKf($admin, 'id', 'name', $user['data'], 'adminId', 'adminName');
        return response()->json($list);
    }

    public function editRow(Request $request)
    {

        if ($request->oper == 'add') {
            $isSet = CustomerModel::where('name', $request->name)->exists();
            if($isSet){
                return response()->json(['code' => -1, 'msg' => '该客户名称已存在']);
            }
            $user = Auth::user();
            $customer = new CustomerModel;
            $customer->name = $request->name;
            $customer->adminId = $user->id;
            $customer->mobile = $request->mobile;
            $customer->addr = $request->addr;

        } else if ($request->oper == 'edit') {
            $customer = CustomerModel::find($request->id);
            $customer->name = $request->name;
            $customer->mobile = $request->mobile;
            $customer->addr = $request->addr;

        } else if ($request->oper == 'del') {
            $customer = CustomerModel::find($request->id);
            $customer->isDel = 1;
        } else {
            return response()->json(['code' => -1, 'msg' => '未知oper']);
        }

        $customer->save();
        return response()->json(['code' => 0]);
    }
}
