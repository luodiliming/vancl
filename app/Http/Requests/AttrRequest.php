<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttrRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'sometimes|required',//要求是输入时才验证|  和  不能为空！
        ];
    }


//    报错信息方法
        public function messages(){
        return [
        'title.required'=>'属性名称不能为空',

        ];
     }
}
