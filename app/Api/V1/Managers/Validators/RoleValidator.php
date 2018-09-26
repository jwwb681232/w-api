<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/9/26
 * Time: 16:50
 */

namespace App\Api\V1\Managers\Validators;

use \Prettus\Validator\LaravelValidator;
use \Prettus\Validator\Contracts\ValidatorInterface;

class RoleValidator extends LaravelValidator implements ValidatorInterface
{
    protected $rules
        = [
            'store'    => [
                'name'    => 'required|max:255',
                'guard_name' => 'sometimes|max:255|in:admin,web',
            ],
        ];

    protected $messages
        = [
            //'email.email'=>'1111111111111'
        ];

}