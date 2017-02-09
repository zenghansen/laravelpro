<?php

namespace App\Http\Controllers\Jg;


use App\Models\Jg\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        view()->share('loginUrl', '/admin/jg/login/login');
        view()->share('getUrl', '/admin/jg/login/list');
        view()->share('editUrl', '/admin/jg/login/edit');
        view()->share('nav',json_encode([]));
    }

    public function tpl()
    {
        $jsList = ['js/jg/login/index.js'];
        return view('jg/login.index', ['jsList' => $jsList]);
    }


    public function login(Request $request)
    {

        if (Auth::attempt(['name' => $request->name, 'password' => $request->password],false)) {
            // 认证通过...
            return response()->json(['code' => 0]);
        }
        return response()->json(['code' => -1, 'msg' => '账号或密码错误']);

    }
    public function logout(Request $request)
    {

        Auth::logout();

    }
}
