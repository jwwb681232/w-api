<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/9/21
 * Time: 10:55
 */

namespace App\Api\V1\Managers\Controllers;

use App\Api\V1\Managers\Validators\AuthValidator;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Api\V1\Managers\Repositories\ManagerRepository;
use Prettus\Validator\Exceptions\ValidatorException;

class AuthController extends BaseController
{
    use Helpers;
    public $repository;
    public $validator;

    public function __construct(ManagerRepository $repository, AuthValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * @SWG\POST(path="/index.php/api/managers/auth/login",
     *   tags={"managers/auth"},
     *   summary="登录",
     *   description="登录",
     *   operationId="login",
     *   consumes={"application/x-www-form-urlencoded"},
     *   @SWG\Parameter(in="formData",  name="email",type="string",  description="邮箱", required=true),
     *   @SWG\Parameter(in="formData",  name="password",type="string",  description="密码", required=true),
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
            $data = $this->repository->login($request);

            return ApiSuccess($data);
        } catch (ValidatorException $e) {
            return ApiValidatorFail($e->getMessageBag());
        }
    }
}