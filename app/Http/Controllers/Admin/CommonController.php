<?php
//这个类里面的方法是用来放验证中间件的！ 让其他的控制器继承中间件
namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class CommonController extends Controller
{
//    默认执行
    public function __construct()
    {
        $this->middleware('Adminlogin')->except(['login','loginin']);//后面是排除了.因为不能让他走这个呀
    }

}
