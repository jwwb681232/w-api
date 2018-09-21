<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/9/21
 * Time: 13:47
 */

namespace App\Api\V1\Managers\Repositories;

use App\Entities\Manager;
use Illuminate\Support\MessageBag;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Validator\Exceptions\ValidatorException;

class ManagerRepository extends BaseRepository
{
    public function model()
    {
        return Manager::class;
    }

    public function login($request)
    {
        return $request->all();
        //$this->model->findOrFail(1);
        //throw new ValidatorException(new MessageBag(['123'=>'123123214123']));
    }
}