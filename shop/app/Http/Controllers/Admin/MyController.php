<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\passwordRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class MyController extends CommonController
{
    public function passwordForm(){
        return view('admin.my.index');
    }

    public function changePassword(passwordRequest $request){
        //获取当前登录用户的所有数据信息
        $model = Auth::user();
        //只修改密码
        $model->password = bcrypt($request['password']);
        //用模型的保存数据
        $model->save();
//        flash()->overlay('密码修改成功');
//        return redirect('/admin/index');
        return redirect()->back();
    }
}
