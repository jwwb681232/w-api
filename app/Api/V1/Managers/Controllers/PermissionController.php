<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/9/26
 * Time: 18:00
 */

namespace App\Api\V1\Managers\Controllers;

use App\Api\V1\Managers\Criteria\Permission\IndexCriteria;
use App\Api\V1\Managers\Presenters\Permission\IndexPresenter;
use App\Api\V1\Managers\Repositories\PermissionRepository;
use App\Api\V1\Managers\Validators\PermissionValidator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Prettus\Validator\Exceptions\ValidatorException;

class PermissionController extends BaseController
{
    public $repository;
    public $validator;

    public function __construct(PermissionRepository $repository, PermissionValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * @SWG\Post(path="/index.php/api/managers/permissions",
     *   tags={"managers/permissions"},
     *   summary="创建权限",
     *   description="创建权限",
     *   operationId="permissions-store",
     *   consumes={"application/x-www-form-urlencoded"},
     *   @SWG\Parameter(in="formData",  name="name",type="string",  description="权限名称", required=true),
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

    /**
     * @SWG\Delete(path="/index.php/api/managers/permissions/{id}",
     *   tags={"managers/permissions"},
     *   summary="删除权限",
     *   description="删除权限",
     *   operationId="permissions-destroy",
     *   consumes={"application/x-www-form-urlencoded"},
     *   @SWG\Parameter(in="path",  name="id",type="integer",  description="权限id", required=true),
     *   @SWG\Parameter(in="header",  name="Accept",  type="string",  description="版本号", default="application/x.w-api.v1+json",required=true),
     *   @SWG\Parameter(in="header",  name="Authorization",  type="string",  description="Token 前面需要加：'bearer '",required=true),
     *   @SWG\Response(response=403, description="无权限"),
     *   @SWG\Response(response="500", description=""),
     * )
     */
    public function destroy($id)
    {
        return ApiSuccess($this->repository->delete($id));
    }

    /**
     * @SWG\Patch(path="/index.php/api/managers/permissions/{id}",
     *   tags={"managers/permissions"},
     *   summary="更新权限",
     *   description="更新权限",
     *   operationId="permissions-update",
     *   consumes={"application/x-www-form-urlencoded"},
     *   @SWG\Parameter(in="path",  name="id",type="integer",  description="权限id", required=true),
     *   @SWG\Parameter(in="formData",  name="name",type="string",  description="权限名称", required=false),
     *   @SWG\Parameter(in="header",  name="Accept",  type="string",  description="版本号", default="application/x.w-api.v1+json",required=true),
     *   @SWG\Parameter(in="header",  name="Authorization",  type="string",  description="Token 前面需要加：'bearer '",required=true),
     *   @SWG\Response(response=403, description="无权限"),
     *   @SWG\Response(response="500", description=""),
     * )
     */
    public function update(Request $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail('update');

            return ApiSuccess($this->repository->update($request->all(), $id));
        } catch (ValidatorException $e) {
            return ApiValidatorFail($e->getMessageBag());
        }
    }

    /**
     * @SWG\Get(path="/index.php/api/managers/permissions",
     *   tags={"managers/permissions"},
     *   summary="权限列表",
     *   description="权限列表",
     *   operationId="permissions-index",
     *   consumes={"application/x-www-form-urlencoded"},
     *   @SWG\Parameter(in="query",  name="cur_page",type="string",  description="当前页", required=false),
     *   @SWG\Parameter(in="query",  name="page_size",type="integer",  description="每页条数", required=false),
     *   @SWG\Parameter(in="query",  name="keyword",type="integer",  description="关键字", required=false),
     *   @SWG\Parameter(in="header",  name="Accept",  type="string",  description="版本号", default="application/x.w-api.v1+json",required=true),
     *   @SWG\Parameter(in="header",  name="Authorization",  type="string",  description="Token 前面需要加：'bearer '",required=true),
     *   @SWG\Response(response=403, description="无权限"),
     *   @SWG\Response(response="500", description=""),
     * )
     */
    public function index(Request $request)
    {
        try {
            $this->repository->pushCriteria(IndexCriteria::class);
            $this->repository->setPresenter(IndexPresenter::class);

            return ApiSuccess($this->repository->search($request));
        } catch (ValidatorException $e) {
            return ApiValidatorFail($e->getMessageBag());
        }
    }

}