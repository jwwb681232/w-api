<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/9/21
 * Time: 10:46
 */
namespace App\Api\V4\Member\Controllers;

use Illuminate\Routing\Controller as BaseController;

class SwaggerController extends BaseController
{
    /**
     * @SWG\Swagger(
     *   @SWG\Info(
     *     title="W-Api Background management system",
     *     version="v1"
     *   )
     * )
     */
    public function getJson()
    {
        return response()->json(\Swagger\scan(app_path('Api/V1/Managers/Controllers/')), 200);
    }
}