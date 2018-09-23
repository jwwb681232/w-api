<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/9/23
 * Time: 10:32
 */

namespace App\Api\V1\Managers\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Api\V1\Managers\Validators\AdminMenuValidator;
use App\Api\V1\Managers\Repositories\AdminMenuRepository;
use Prettus\Validator\Exceptions\ValidatorException;

class AdminMenuController extends BaseController
{
    public $repository;
    public $validator;

    public function __construct(AdminMenuRepository $repository, AdminMenuValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * @SWG\Post(path="/index.php/api/managers/admin-menus",
     *   tags={"managers/admin-menus"},
     *   summary="创建后台菜单",
     *   description="创建后台菜单",
     *   operationId="store",
     *   consumes={"application/x-www-form-urlencoded"},
     *   @SWG\Parameter(in="formData",  name="name",type="string",  description="菜单名称", required=true),
     *   @SWG\Parameter(in="formData",  name="parent_id",type="integer",  description="上级菜单", required=false),
     *   @SWG\Parameter(in="header",  name="Accept",  type="string",  description="版本号", default="application/x.w-api.v1+json",required=true),
     *   @SWG\Parameter(in="header",  name="Authorization",  type="string",  description="Token 前面需要加：'bearer '",required=true),
     *   @SWG\Response(response=403, description="无权限"),
     *   @SWG\Response(response="500", description=""),
     * )
     */
    public function store(Request $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail('store');

            return ApiSuccess($this->repository->create($request->all()));
        } catch (ValidatorException $e) {
            return ApiValidatorFail($e->getMessageBag());
        }
    }
}