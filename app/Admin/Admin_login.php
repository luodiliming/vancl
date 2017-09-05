<?php

namespace App\Admin;


use Illuminate\Foundation\Auth\User;//它命名空间是大写App    use引的时候就需要大写！   继承他才有验证！
//要找Illuminate\Foundation\Auth\User;   这个User 才行！
class Admin_login extends User
{
    protected $rememberTokenName = '';


}
