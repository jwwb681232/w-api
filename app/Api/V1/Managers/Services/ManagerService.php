<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/9/29
 * Time: 14:32
 */

namespace App\Api\V1\Managers\Services;

use App\Entities\Manager;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Hash;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Api\V1\Managers\Repositories\ManagerRepository;
use App\Api\V1\Managers\Repositories\AdminMenuRepository;

class ManagerService
{
    public $managerRepository;
    public $adminMenuRepository;

    public function __construct(
        ManagerRepository $managerRepository,
        AdminMenuRepository $adminMenuRepository
    ) {
        $this->managerRepository   = $managerRepository;
        $this->adminMenuRepository = $adminMenuRepository;
    }

    /**
     * @param $request
     *
     * @return array
     * @throws ValidatorException
     */
    public function register($request)
    {
        $data['name']     = $request->name;
        $data['email']    = $request->email;
        $data['password'] = bcrypt($request->password);

        if ($manager = $this->managerRepository->create($data)) {
            return [
                'manager' => $manager,
                'token'   => $this->managerRepository->getToken($manager->id),
            ];
        }

        throw new ValidatorException(new MessageBag(['Http Exception']));
    }

    /**
     * login
     *
     * @param $request
     *
     * @return mixed
     * @throws ValidatorException
     */
    public function login($request)
    {
        $manager = $this->managerRepository->first();

        if ( ! $manager) {
            throw new ValidatorException(new MessageBag(['Can\'t find this e-mail account']));
        }

        if ( ! Hash::check($request->password, $manager->password)) {
            throw new ValidatorException(new MessageBag(['Incorrect password for account']));
        }

        return $this->getInfo($manager);
    }

    /**
     * user info
     *
     * @param Manager $manager
     *
     * @return mixed
     */
    public function getInfo(Manager $manager)
    {
        $hasPermissions = array_column($manager->getAllPermissions()->toArray(), 'name');
        $adminMenus     = $this->adminMenuRepository->all(['id', 'name', 'parent_id', 'permission_name']);
        $info           = $manager->toArray();
        $hasMenus       = $this->permissionMenus($hasPermissions, $adminMenus);
        unset($info['roles'], $info['permissions']);

        $data['info']        = $info;
        $data['token']       = $this->managerRepository->getToken($manager->id);
        $data['roles']       = $manager->getRoleNames();
        $data['permissions'] = $hasPermissions;
        $data['menus']       = $this->adminMenuRepository->tree($hasMenus);

        return $data;
    }

    /**
     * get user has permission menus
     *
     * @param array $hasPermissions
     * @param       $menus
     *
     * @return      array
     */
    private function permissionMenus(array $hasPermissions, $menus)
    {
        $menus = $menus->keyBy('permission_name');
        foreach ($menus as $key => $menu) {
            if ( ! in_array($key, $hasPermissions)) {
                $menus->forget($key);
            }
        }

        return $menus;
    }
}