<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/9/21
 * Time: 13:52
 */

namespace App\Api\V1\Managers\Validators;

use \Prettus\Validator\LaravelValidator;
use \Prettus\Validator\Contracts\ValidatorInterface;

class AuthValidator extends LaravelValidator implements ValidatorInterface
{
    protected $rules= [
            'login' => [
                'email' => 'required|email|min:5',
                'password'=>'required|between:8,20',
            ],
            'forgetPasswordSendMail'=>[
                'email'=>'required|email|min:5'
            ],
            'forgetPassword'=>[
                'email'=>'required|email|min:5',
                'captcha'=>'required|size:6',
                'password'=>'required|between:8,20|confirmed',
            ],
            'updatePassword'=>[
                'old_password'=>'required||between:8,20',
                'password'=>'required|between:8,20|confirmed',
            ],
        ];

    protected $messages = [
        //'email.email'=>'1111111111111'
    ];

}