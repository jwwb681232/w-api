<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/9/21
 * Time: 10:55
 */

namespace App\Api\V1\Managers\Controllers;

use App\Api\V1\Managers\Services\ManagerService;
use Illuminate\Http\Request;
use App\Api\V1\Managers\Validators\AuthValidator;
use App\Api\V1\Managers\Criteria\Auth\LoginCriteria;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Routing\Controller as BaseController;

class AuthController extends BaseController
{
    public $validator;
    public $managerService;

    public function __construct(ManagerService $managerService, AuthValidator $validator)
    {
        $this->managerService = $managerService;
        $this->validator      = $validator;
    }

    /**
     * @SWG\POST(path="/index.php/api/managers/auth/register",
     *   tags={"managers/auth"},
     *   summary="注册",
     *   description="注册",
     *   operationId="auth-register",
     *   consumes={"application/x-www-form-urlencoded"},
     *   @SWG\Parameter(in="formData",  name="email",type="string",  description="邮箱", required=true),
     *   @SWG\Parameter(in="formData",  name="name",type="string",  description="用户名", required=true),
     *   @SWG\Parameter(in="formData",  name="password",type="string",  description="密码", required=true),
     *   @SWG\Parameter(in="formData",  name="password_confirmation",type="string",  description="确认密码", required=true),
     *   @SWG\Parameter(in="header",  name="Content-Type",  type="string",  description="application/x-www-form-urlencoded", default="application/x-www-form-urlencoded",required=true),
     *   @SWG\Parameter(in="header",  name="Accept",  type="string",  description="版本号", default="application/x.w-api.v1+json",required=true),
     *   @SWG\Response(response=403, description="无权限"),
     *   @SWG\Response(response=500, description=""),
     * )
     */
    public function register(Request $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail('register');
            $data = $this->managerService->register($request);

            return ApiSuccess($data);
        } catch (ValidatorException $e) {
            return ApiValidatorFail($e->getMessageBag());
        }
    }

    /**
     * @SWG\POST(path="/index.php/api/managers/auth/login",
     *   tags={"managers/auth"},
     *   summary="登录",
     *   description="登录",
     *   operationId="auth-login",
     *   consumes={"application/x-www-form-urlencoded"},
     *   @SWG\Parameter(in="formData",  name="email",type="string",  description="邮箱", default="admin@admin.com",required=true),
     *   @SWG\Parameter(in="formData",  name="password",type="string",  description="密码",default="123456", required=true),
     *   @SWG\Parameter(in="header",  name="Content-Type",  type="string",  description="application/x-www-form-urlencoded", default="application/x-www-form-urlencoded",required=true),
     *   @SWG\Parameter(in="header",  name="Accept",  type="string",  description="版本号", default="application/x.w-api.v1+json",required=true),
     *   @SWG\Response(response=403, description="无权限"),
     *   @SWG\Response(response="500", description=""),
     * )
     */
    public function login(Request $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail('login');
            $this->managerService->managerRepository->pushCriteria(LoginCriteria::class);
            $data = $this->managerService->login($request);

            return ApiSuccess($data);
        } catch (ValidatorException $e) {
            return ApiValidatorFail($e->getMessageBag());
        }
    }

    /**
     * @SWG\Post(path="/index.php/api/managers/auth/logout",
     *   tags={"managers/auth"},
     *   summary="登出",
     *   description="登出",
     *   operationId="auth-logout",
     *   consumes={"application/x-www-form-urlencoded"},
     *   @SWG\Parameter(in="header",  name="Accept",  type="string",  description="版本号", default="application/x.w-api.v1+json",required=true),
     *   @SWG\Parameter(in="header",  name="Authorization",  type="string",  description="Token 前面需要加：'bearer '",required=true),
     *   @SWG\Response(response=403, description="无权限"),
     *   @SWG\Response(response="500", description=""),
     * )
     */
    public function logout(Request $request)
    {
        return ApiSuccess(auth('manager')->logout());
    }

    /**
     * @SWG\Get(path="/index.php/api/managers/auth/info",
     *   tags={"managers/auth"},
     *   summary="个人信息",
     *   description="个人信息",
     *   operationId="auth-info",
     *   consumes={"application/x-www-form-urlencoded"},
     *   @SWG\Parameter(in="header",  name="Accept",  type="string",  description="版本号", default="application/x.w-api.v1+json",required=true),
     *   @SWG\Parameter(in="header",  name="Authorization",  type="string",  description="Token 前面需要加：'bearer '",required=true),
     *   @SWG\Response(response=403, description="无权限"),
     *   @SWG\Response(response="500", description=""),
     * )
     */
    public function info(Request $request)
    {
        return ApiSuccess(
            $this->managerService->getInfo(auth('manager')->user())
        );
    }
}