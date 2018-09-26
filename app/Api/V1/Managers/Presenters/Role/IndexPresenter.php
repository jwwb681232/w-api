<?php
/**
 * Created by PhpStorm.
 * User: WangXiao
 * Date: 2018/9/26
 * Time: 17:27
 */

namespace App\Api\V1\Managers\Presenters\Role;

use Prettus\Repository\Presenter\FractalPresenter;
use App\Api\V1\Managers\Transformers\Role\IndexTransformer;

class IndexPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new IndexTransformer();
    }
}