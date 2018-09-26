<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/9/26
 * Time: 18:00
 */

namespace App\Api\V1\Managers\Repositories;

use App\Entities\Permission;
use Prettus\Repository\Eloquent\BaseRepository;

class PermissionRepository extends BaseRepository
{
    public function model()
    {
        return Permission::class;
    }

    /**
     * @param $request
     *
     * @return mixed
     */
    public function search($request)
    {
        $this->applyCriteria();

        $curPage  = $request->input('cur_page', 1);
        $pageSize = $request->input('page_size', 10);
        $offset   = ($curPage - 1) * $pageSize;

        $condition = $this->model;

        $data['count'] = $condition->count();

        $data['cur_page'] = $curPage;

        $data['page_count'] = ceil($data['count'] / $pageSize);

        $parserResult = $this->parserResult(
            $condition->offset($offset)->limit($pageSize)->orderBy('id','desc')->get(['id','name'])
        );

        $data['list'] = $parserResult['data'];

        return $data;
    }
}