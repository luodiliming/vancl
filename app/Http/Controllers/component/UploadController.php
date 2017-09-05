<?php

namespace App\Http\Controllers\component;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    //上传文件
    public function uploader(Request $request){//模型注入
           $file =$request->file;//调用获得文件的方法->file
// 文件是否上传成功 调用这个方法！
        if ($file->isValid()){
//               变量调用存储方法里面写ymd年月起名字！后面是目录的名字
            $path  = $file->store(date('ymd'),'fileupload');//在写一个变量接收一下。
            return ['valid'=>1,'message'=>asset('fileupload/' . $path)];//返回  真！然后创建这个文件夹
        }
            return ['valid'=>0,'message'=>'图片上传失败'];//假就是上传失败！
    }

    ////获取文件列表
    public function filesLists(){
        return [ 'data' => [], 'page' => ''];
    }
}
