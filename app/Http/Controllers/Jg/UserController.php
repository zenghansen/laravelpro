<?php

namespace App\Http\Controllers\Jg;


use App\Models\Jg\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        view()->share('getUrl', '/admin/jg/user/list');
        view()->share('editUrl', '/admin/jg/user/edit');
    }

    public function tpl()
    {
        $jsList = ['js/jg/user/index.js'];
        return view('jg/user.index', ['jsList' => $jsList]);
    }

    public function getList(Request $request)
    {
        $pageSize = $request->rows;

        $user = new UserModel();

        $data = $user->where("isDel", 0)->where("name", '!=', 'admin')->orderBy('created_at')->paginate($pageSize);

        return response()->json($data);
    }

    public function editRow(Request $request)
    {

        if ($request->oper == 'add') {
            $user = new UserModel;
            $user->name = $request->name;
            $user->password = bcrypt($request->password);
            $user->roleId = $request->roleId;
            $user->realName = $request->realName;

        } else if ($request->oper == 'edit') {
            $user = UserModel::find($request->id);
            $user->name = $request->name;
            if ($user->password != $request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->roleId = $request->roleId;
            $user->realName = $request->realName;

        } else if ($request->oper == 'del') {
            $user = UserModel::find($request->id);
            $user->isDel = 1;
        } else {
            return response()->json(['code' => -1, 'msg' => '未知oper']);;
        }

        $user->save();
        return response()->json(['code' => 0]);
    }
}
