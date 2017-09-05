<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\PasswordRequest;
use App\Http\Controllers\Controller;
use Auth;

class PasswordController extends Controller
{
//    进入修改密码页面
    public function PasswordForm(){
        return view('admin.password.index');
    }

//    修改密码方法                    进行模型注入
    public function changePassword(PasswordRequest $request){
        //获取当前登录用户的所有数据信息
        $model = Auth::guard('adminlogin')->user();
        //只修改密码
        $model->password = bcrypt($request['password']);
        //用模型的保存数据
        $model->save();
        flash()->overlay('密码修改成功');
        return redirect()->back(); //重定向返回上页
    }
}
