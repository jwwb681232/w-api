<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/9/26
 * Time: 16:45
 */

namespace App\Api\V1\Managers\Controllers;

use App\Api\V1\Managers\Repositories\RoleRepository;
use App\Api\V1\Managers\Validators\RoleValidator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Prettus\Validator\Exceptions\ValidatorException;

class RoleController extends BaseController
{
    public $repository;
    public $validator;

    public function __construct(RoleRepository $repository, RoleValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * @SWG\Post(path="/index.php/api/managers/roles",
     *   tags={"managers/roles"},
     *   summary="创建角色",
     *   description="创建角色",
     *   operationId="roles-store",
     *   consumes={"application/x-www-form-urlencoded"},
     *   @SWG\Parameter(in="formData",  name="name",type="string",  description="角色名称", required=true),
     *   @SWG\Parameter(in="formData",  name="guard_name",type="string",  description="守卫", required=true),
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