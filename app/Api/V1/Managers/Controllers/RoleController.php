<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/9/26
 * Time: 16:45
 */

namespace App\Api\V1\Managers\Controllers;

use App\Api\V1\Managers\Criteria\Role\IndexCriteria;
use App\Api\V1\Managers\Presenters\Role\IndexPresenter;
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

    /**
     * @SWG\Delete(path="/index.php/api/managers/roles/{id}",
     *   tags={"managers/roles"},
     *   summary="删除角色",
     *   description="删除角色",
     *   operationId="roles-destroy",
     *   consumes={"application/x-www-form-urlencoded"},
     *   @SWG\Parameter(in="path",  name="id",type="integer",  description="角色id", required=true),
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
     * @SWG\Patch(path="/index.php/api/managers/roles/{id}",
     *   tags={"managers/roles"},
     *   summary="更新角色",
     *   description="更新角色",
     *   operationId="roles-update",
     *   consumes={"application/x-www-form-urlencoded"},
     *   @SWG\Parameter(in="path",  name="id",type="integer",  description="角色id", required=true),
     *   @SWG\Parameter(in="formData",  name="name",type="string",  description="角色名称", required=false),
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
     * @SWG\Get(path="/index.php/api/managers/roles",
     *   tags={"managers/roles"},
     *   summary="角色列表",
     *   description="角色列表",
     *   operationId="roles-index",
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