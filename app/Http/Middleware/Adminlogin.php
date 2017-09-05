<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Adminlogin
{

    public function handle($request, Closure $next)
    {

        //判断Auth的守卫里面的adminlogin数组进行 ->check()验证   如果是否的话  就返回重定向1！
        if (!Auth::guard('adminlogin')->check()){

            return redirect('admin/login');
        }
            //这个不用管它真就是没干系！
        return $next($request);
    }
}
