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
    protected $rules
        = [
            'store'   => [
                'name'           => 'required|string|max:255',
                'permission_tag' => 'required|string|max:255',
                'parent_id'      => 'sometimes|integer|min:0',
            ],
            'destroy' => [
                'id' => 'required|integer|min:1',
            ],
            'update'  => [
                'name'           => 'sometimes|string|max:255',
                'permission_tag' => 'sometimes|string|max:255',
                'parent_id'      => 'sometimes|integer|min:0',
            ],
        ];

    protected $messages
        = [
            //'email.email'=>'1111111111111'
        ];

}