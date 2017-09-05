<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $guarded = [];

    //    protected $guarded = [];   $guarded的不能改的！他是一个属性  意思是说不允许填充的字段有哪些！给个{}  代表都允许填充的意思！
}
