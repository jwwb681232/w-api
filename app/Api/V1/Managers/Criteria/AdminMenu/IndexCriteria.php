<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/9/24
 * Time: 10:26
 */

namespace App\Api\V1\Managers\Criteria\AdminMenu;

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