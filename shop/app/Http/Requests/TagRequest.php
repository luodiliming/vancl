<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class TagRequest extends FormRequest
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
            'name'=>'sometimes|required',
        ];
    }
    //自定义错误消息，转成中文
    public function messages()
    {
        return [
            'name.required' => '标签名称不能为空',
        ];
    }
}
