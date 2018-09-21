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
                'password'=>'required|between:6,30',
            ],
            'register'=>[
                'email' => 'required|email|between:5,30|unique:managers',
                'name' => 'required|between:3,30',
                'password'=>'required|confirmed|between:6,30',
            ],
        ];

    protected $messages = [
        //'email.email'=>'1111111111111'
    ];

}