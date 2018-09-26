<?php
/**
 * Created by PhpStorm.
 * User: WangXiao
 * Date: 2018/9/26
 * Time: 18:00
 */

namespace App\Api\V1\Managers\Transformers\Permission;

use App\Entities\Permission;
use League\Fractal\TransformerAbstract;

/**
 * Class PermissionTransformer.
 *
 * @package namespace App\Transformers;
 */
class IndexTransformer extends TransformerAbstract
{
    /**
     * Transform the Permission entity.
     *
     * @param \App\Entities\Permission $model
     *
     * @return array
     */
    public function transform(Permission $model)
    {
        return [
            'id'   => $model->id,
            'name' => $model->name,
        ];
    }
}