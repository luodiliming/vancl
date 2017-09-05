<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Request;
class LoginController extends CommonController
{

    public function index(){
        return view('admin.index');
    }
    public function login(){
        return view('admin.login');
    }
    public function loginin(){
        $status = Auth::attempt([
            'username'=> Request::input('username'),
            'password'=> Request::input('password'),
        ]);
        if ($status){
            return redirect('/admin/index');
        }else{
            return redirect('/admin/login')->with('error','用户名或密码错误');
        }
    }
}
