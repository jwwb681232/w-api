<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/9/21
 * Time: 13:47
 */

namespace App\Api\V1\Managers\Repositories;

use App\Entities\Manager;
use Prettus\Repository\Eloquent\BaseRepository;

class ManagerRepository extends BaseRepository
{
    public function model()
    {
        return Manager::class;
    }

    /**
     * @param $managerId
     *
     * @return bool|string
     */
    public function getToken($managerId)
    {
        return auth('manager')->attempt(['id' => $managerId]);
    }
}