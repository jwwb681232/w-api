<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/9/26
 * Time: 18:00
 */

namespace App\Api\V1\Managers\Validators;

use \Prettus\Validator\LaravelValidator;
use \Prettus\Validator\Contracts\ValidatorInterface;

class PermissionValidator extends LaravelValidator implements ValidatorInterface
{
    protected $rules
        = [
            'store'    => [
                'name'    => 'required|max:255',
                'guard_name' => 'sometimes|max:255|in:admin,web',
            ],
            'update'    => [
                'name'    => 'sometimes|max:255',
                'guard_name' => 'sometimes|max:255|in:admin,web',
            ],
        ];

    protected $messages
        = [
            //'email.email'=>'1111111111111'
        ];

}