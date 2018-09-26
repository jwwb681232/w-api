<?php
/**
 * Created by PhpStorm.
 * User: WangXiao
 * Date: 2018/9/26
 * Time: 17:27
 */

namespace App\Api\V1\Managers\Transformers\Role;

use App\Entities\Role;
use League\Fractal\TransformerAbstract;

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
     * @param \App\Entities\Role $model
     *
     * @return array
     */
    public function transform(Role $model)
    {
        return [
            'id'   => $model->id,
            'name' => $model->name,
        ];
    }
}