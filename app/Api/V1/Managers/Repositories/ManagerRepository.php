<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/9/21
 * Time: 13:47
 */

namespace App\Api\V1\Managers\Repositories;

use App\Entities\Manager;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Hash;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Validator\Exceptions\ValidatorException;

class ManagerRepository extends BaseRepository
{
    public function model()
    {
        return Manager::class;
    }

    /**
     * @param $request
     *
     * @return array
     * @throws ValidatorException
     */
    public function login($request)
    {
        $manager = $this->first();

        if ( ! $manager) {
            throw new ValidatorException(new MessageBag(['Can\'t find this e-mail account']));
        }

        if ( ! Hash::check($request->password, $manager->password)) {
            throw new ValidatorException(new MessageBag(['Incorrect password for account']));
        }

        return [
            'manager' => $manager,
            'token'   => $this->getToken($manager->id),
        ];

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

        if ($manager = $this->create($data)) {
            return [
                'manager' => $manager,
                'token'   => $this->getToken($manager->id),
            ];
        }

        throw new ValidatorException(new MessageBag(['Http Exception']));
    }

    /**
     * @param $managerId
     *
     * @return bool|string
     */
    private function getToken($managerId)
    {
        return auth('manager')->attempt(['id' => $managerId]);
    }
}