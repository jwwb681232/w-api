<?php
/**
 * Created by PhpStorm.
 * User: WangXiao
 * Date: 2018/9/26
 * Time: 18:00
 */

namespace App\Api\V1\Managers\Presenters\Permission;

use Prettus\Repository\Presenter\FractalPresenter;
use App\Api\V1\Managers\Transformers\Permission\IndexTransformer;

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