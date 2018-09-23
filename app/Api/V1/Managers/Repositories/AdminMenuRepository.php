<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/23
 * Time: 10:33
 */

namespace App\Api\V1\Managers\Repositories;

use App\Entities\AdminMenu;
use Prettus\Repository\Eloquent\BaseRepository;

class AdminMenuRepository extends BaseRepository
{
    public function model()
    {
        return AdminMenu::class;
    }

}