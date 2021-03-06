<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/9/26
 * Time: 18:00
 */

namespace App\Api\V1\Managers\Criteria\Permission;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class IndexCriteria implements CriteriaInterface
{
    public function apply($model, RepositoryInterface $repository)
    {
        $keyWord = request('keyword');

        return $model->when($keyWord,function($query)use($keyWord){
            return $query->where('name','like',"%{$keyWord}%");
        });
    }
}