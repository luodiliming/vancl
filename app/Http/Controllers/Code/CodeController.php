<?php

namespace App\Http\Controllers\Code;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CodeController extends Controller
{
    public function code(){

        require_once("../resources/views/code/Code.class.php");

        //实例化
        $code = new \Code();

//        生成验证码
        $code->make();

    }
}
