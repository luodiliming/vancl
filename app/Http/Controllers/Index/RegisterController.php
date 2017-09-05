<?php

namespace App\Http\Controllers\Index;

use App\Home\Home_register;//注册模型！
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequests;//注册表验证！


use Illuminate\Support\Facades\Request;   //现在调用服务需要用这个样的引入 ！
use Illuminate\Support\Facades\Auth;//自动验证服务
class RegisterController extends Controller
{
//        进入注册页面
   public function register(){

        return view('index.register.register');
   }

//    储存注册用户的方法
    public function storeregister(RegisterRequests $request,Home_register $home_register){

       $home_register->create([
        'username' => $request['username'],
        'password' => bcrypt($request['password']),
         'password_confirmation' => bcrypt($request['password_confirmation']),
        ]);
            return redirect('/index/login');//重定向！验证注册方法！
    }


    //前台展示登录页面方法！
   public function login(){

        return view('index.register.login');
   }


    //前台登录验证方法
    public function loginin(){
//        需要调用自定验证服务Auht


      $data = Auth::guard('homelogin')->attempt([  //attempt会把post来的参数跟守卫对比！
            'username'=>Request::input('username'),//是post到的存进两个字段
            'password'=>Request::input('password'),//inputh跟post  一个功能！
        ]);

        if($data){
            //匹配成功的话走  下面这个路由 进前台页面！
            return redirect('/');
        }
//        错误的话就走
        return redirect('/index/login')->with('error','用户名或密码错误！！');//这个方法是动态视图赋值！可到页面判断显示！一般都在重定向后面调用！error是存在 session里面的！
    }

//            退出前台管理
        public function loginout(){
// 用Auth服务和守卫里面的adminlogin 直接调用退出方法！->logout 框架退出方法！
            Auth::guard('homelogin')->logout();
            return redirect('/');

        }


}
