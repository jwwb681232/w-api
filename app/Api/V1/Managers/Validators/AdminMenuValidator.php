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

class AdminMenuValidator extends LaravelValidator implements ValidatorInterface
{
    protected $rules= [
            'store' => [
                'name' => 'required|string|between:1,255',
                'parent_id'=>'sometimes|integer|min:0',
            ],
            'destroy' => [
                'id' => 'required|integer|min:1',
                'force'=>'sometimes|boolean'
            ],
        ];

    protected $messages = [
        //'email.email'=>'1111111111111'
    ];

}