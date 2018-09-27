<?php
/**
 * Created by PhpStorm.
 * User: WangXiao
 * Date: 2018/9/24
 * Time: 10:33
 */

namespace App\Api\V1\Managers\Transformers\AdminMenu;

use League\Fractal\TransformerAbstract;
use App\Entities\AdminMenu;

/**
 * Class RoleTransformer.
 *
 * @package namespace App\Transformers;
 */
class IndexTransformer extends TransformerAbstract
{
    /**
     * Transform the Role entity.
     *
     * @param \App\Entities\AdminMenu $model
     *
     * @return array
     */
    public function transform(AdminMenu $model)
    {
        return [
            'id'             => $model->id,
            'name'           => $model->name,
            'permission_tag' => $model->permission_tag,
        ];
    }
}