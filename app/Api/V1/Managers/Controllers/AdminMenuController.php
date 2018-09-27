<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/9/23
 * Time: 10:32
 */

namespace App\Api\V1\Managers\Controllers;

use App\Api\V1\Managers\Criteria\AdminMenu\IndexCriteria;
use App\Api\V1\Managers\Presenters\AdminMenu\IndexPresenter;
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
     *   operationId="admin-menus-store",
     *   consumes={"application/x-www-form-urlencoded"},
     *   @SWG\Parameter(in="formData",  name="name",type="string",  description="菜单名称", required=true),
     *   @SWG\Parameter(in="formData",  name="permission_tag",type="string",  description="菜单权限", required=true),
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

    /**
     * @SWG\Delete(path="/index.php/api/managers/admin-menus/{id}",
     *   tags={"managers/admin-menus"},
     *   summary="软删除后台菜单",
     *   description="软删除后台菜单",
     *   operationId="admin-menus-destroy",
     *   consumes={"application/x-www-form-urlencoded"},
     *   @SWG\Parameter(in="path",  name="id",type="integer",  description="菜单id", required=true),
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
     * @SWG\Patch(path="/index.php/api/managers/admin-menus/{id}",
     *   tags={"managers/admin-menus"},
     *   summary="更新后台菜单",
     *   description="更新后台菜单",
     *   operationId="admin-menus-update",
     *   consumes={"application/x-www-form-urlencoded"},
     *   @SWG\Parameter(in="path",  name="id",type="integer",  description="菜单id", required=true),
     *   @SWG\Parameter(in="formData",  name="name",type="string",  description="菜单名称", required=false),
     *   @SWG\Parameter(in="formData",  name="permission_tag",type="string",  description="菜单权限", required=false),
     *   @SWG\Parameter(in="formData",  name="parent_id",type="integer",  description="上级菜单", required=false),
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
     * @SWG\Get(path="/index.php/api/managers/admin-menus",
     *   tags={"managers/admin-menus"},
     *   summary="后台菜单列表",
     *   description="后台菜单列表",
     *   operationId="admin-menus-index",
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