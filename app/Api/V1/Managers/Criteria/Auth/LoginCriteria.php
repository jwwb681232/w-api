<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/6/1
 * Time: 10:37
 */

namespace App\Api\V1\Managers\Criteria\Auth;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class LoginCriteria implements CriteriaInterface
{
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('email',request('email'));
    }
}