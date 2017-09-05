<?php

namespace App\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
//一定要继承！ User   不在继承Modell了
class Home_register extends User
{
    protected $rememberTokenName='';
}


//注意：必须要在Home_register这个模型里面放置一个字段令牌才行！要不然会报在Home_register模型或表里没有找到这个字段
//Remember_token ！ 所以我们需要模型中添加一个！  protected $rememberTokenName=’’;  给个空！这样就可以了！




//登录验证：注意当写注册或者登录的时候！存数据的那个表，同名的那个模型一定要继承！ use Illuminate\Foundation\Auth\User
//一 定要是Auth！！！！