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

    /**
     * menu tree list
     * @param $data
     *
     * @return array
     */
    public function tree($data)
    {
        if (!is_array($data)){
            $data = $data->toArray();
        }
        $tree = array();
        $tmpMap = array();
        foreach ($data as $k => $v) {
            $tmpMap[$v['id']] = $v;
        }
        foreach ($data as $value) {
            if (isset($tmpMap[$value['parent_id']])) {
                $tmpMap[$value['parent_id']]['child'][] = &$tmpMap[$value['id']];
            } else {
                $tree[] = &$tmpMap[$value['id']];
            }
        }
        unset($tmpMap);
        return $tree;
    }

}