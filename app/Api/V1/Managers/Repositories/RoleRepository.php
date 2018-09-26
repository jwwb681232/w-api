<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/9/26
 * Time: 16:47
 */

namespace App\Api\V1\Managers\Repositories;

use App\Entities\Role;
use Prettus\Repository\Eloquent\BaseRepository;

class RoleRepository extends BaseRepository
{
    public function model()
    {
        return Role::class;
    }
}