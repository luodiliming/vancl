<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Hash;
use Auth;
use Validator;//验证器服务！

class PasswordRequest extends FormRequest
{

    public function authorize()
    {
        return true;//这里首先为true 为使用的意思！
    }
    //这个方法得到的是 输入的原密码 跟数据库里的密码进行对比
    public function boot()
    {
        //    check_oldpassword是一个方法得到的结果只有真或假   1:要被验证的属性名称 2:属性的值 3:传入验证规则的参数数组  4:实例
        Validator::extend('check_oldpassword', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value,Auth::guard('adminlogin')->user()->password);
// Hash：：check 哈希加密 进行密码check对比！  第二个参数是调用Auth::guerd（‘adminlogin’）会获得登录表的数据，在单独用->user()方法调用 password() 就能获得密码！
        });
    }




    public function rules()
    {
//        $this->调用上面的对比方法放到这里！
        $this->boot();
//            加一些输入时的限制，比如全是数字啦 或者不能为空之类的规则
//        在输入数据中有此字段时才进行验证。可通过增加 sometimes 规则到规则列表来实现：
        return [
                'oldpassword'=>'sometimes|required|check_oldpassword',
//                                                            3:长度要到 6-20位
                'password'=>'sometimes|required|confirmed|between:6,20',//confirmed 放进了这个字段，就必须呀跟password_confirmation保持一致
                // 确认密码规则有： 1:输入数据中有此字段时才进行验证 2:不能为空
                'password_confirmation'=>'sometimes|required',
        ];
    }

//            验证失败的错误信息
    public function messages(){
        return [
            'oldpassword.required'=>'旧数据不能为空',
            'password.required' => '新密码不能为空',
            'password_confirmation.required' => '确认密码不能为空',
            'password.confirmed' => '两次密码输入不一致',
            'oldpassword.check_oldpassword' => '旧密码不正确',
            'password.between' => '密码必须是6-20位',

        ];

    }







}
