<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
//属性模型
class Attr extends Model
{
//    protected $guarded = [];   $guarded  的不能改的！他是一个属性  意思是说不允许填充的字段有哪些！给个{}  代表都允许的意思！
    protected $guarded = [];

    public function parent(){

        return $this->belongsTo(static::class, 'pid', $this->getKeyName());
//        返回是的自关联       参数1代表关联自己   pid        这个是主键id属于被关联的！
    }
}




//
//8：因为之前我们写是只是显示他的父级类别是顶级类别还是不是顶级类别。只做一个简单的判断就可以了 是0 是1！而在商品属性中个，我们要
//		区分下，要显示下他的父级属性了。因为还是在一张表上，所以我们需要用 自关联才可以！
//		9：在Attr模型中写一个方法，自关联