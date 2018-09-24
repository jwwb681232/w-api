<?php
/**
 * Created by PhpStorm.
 * User: WangXiao
 * Date: 2018/9/24
 * Time: 10:30
 */

namespace App\Api\V1\Managers\Presenters\AdminMenu;

use Prettus\Repository\Presenter\FractalPresenter;
use App\Api\V1\Managers\Transformers\AdminMenu\IndexTransformer;

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