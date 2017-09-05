<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use Request;//服务
use Auth;//验证服务

class LoginController extends CommonController  //继承了验证中间键的
{

    public function login(){//登录方法
        return view('admin.login.login');//自动找到资源文件夹。views下面的admin/login/login.php

    }


    //登录验证方法
    public function loginin(){
//         dd(Request::input());
//        调用自动验证服务 及 守卫
//        $aa = [//attempt得到这个字段
//
//        ];
//        attempt()这个方法的意思是自动对比守卫里面的后台登录模型或者是表里的数据   于 posh  来的数据 进行对比！

        $data = Auth::guard('adminlogin')->attempt([
            'username'=>Request::input('username'),//是post到的存进两个字段
            'password'=>Request::input('password'),//inputh跟post  一个功能！
        ]);
// attempt 【】中括号也就是post上来的参数！
        //Auth::guard('adminlogin')里面有登录模型相当于有表数据。   和   attempt（）input到的字段进行对比 存进变量里！

        if($data){
//匹配成功的话走  下面这个路由 进后台！
            return redirect('admin/index');
        }
        //假的话就在重定向定回到向登录路由，给句话   去要到登录页面去if判断下 sessor有没有  error!  才能显示这段话
        return redirect('admin/login')->with('error','用户名或密码错误！！');
    }


//            进入后台
            public function index(){
                return view('admin.index');
            }


//            退出后台管理
            public function loginout(){
//                用Auth服务和守卫里面的adminlogin 直接调用退出方法！->logout 框架退出方法！
                    Auth::guard('adminlogin')->logout();
                    return redirect('admin/login');
            }










}
