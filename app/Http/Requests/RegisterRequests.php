<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequests extends FormRequest
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
            'username' => 'sometimes|required',//用户名不为空！
//                                                            3:长度要到 6-20位
            'password'=>'sometimes|required|confirmed|between:6,20',//confirmed 放进了这个字段，就必须呀跟password_confirmation保持一致
            // 确认密码规则有： 1:输入数据中有此字段时才进行验证 2:不能为空
            'password_confirmation'=>'sometimes|required',

        ];
    }



    //            验证失败的错误信息
    public function messages(){
        return [
            'username.required' =>'用户名不能为空',
            'password.required' => '密码不能为空',
            'password_confirmation.required' => '确认密码不能为空',
            'password.confirmed' => '两次密码输入不一致',
            'password.between' => '密码必须是6-20位',
        ];

    }

}
