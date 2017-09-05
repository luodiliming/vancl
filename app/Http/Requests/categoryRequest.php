<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class categoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {//改为ture
        return true;
    }

    /**
     *
     * 输入要求：
     *
     */
    public function rules()
    {
        return [
            'name'=>'sometimes|required',//要求是输入时才验证|  和  不能为空！
        ];
    }

    //自定义错误消息，转成中文，一定方法名叫messages    必须要写在return里面
    public function messages(){

        return [
            'name.required'=>'分类名称不能为空',
        ];

    }



}
