<?php

namespace App\ApiAuth\Providers;

use App\Entities\Manager;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

class EloquentManagerProvider extends EloquentUserProvider
{
    /**
     * 根据主键获取用户实例
     * @param mixed $identifier
     *
     * @return mixed
     */
    public function retrieveById($identifier)
    {
        return Manager::find($identifier);
    }

    /**
     * 根据给定条件获取用户实例
     * @param array $credentials
     *
     * @return mixed
     */
    public function retrieveByCredentials(array $credentials)
    {
        $model = $this->createModel();
        foreach ($credentials as $key => $value) {
            $model = $model->where($key, $value);
        }

        return $model->first();
    }

    /**
     * 对获取的用户实例与给定条件进行对比
     * @param UserContract $user
     * @param array        $credentials
     *
     * @return bool
     */
    public function validateCredentials(UserContract $user, array $credentials)
    {
        foreach ($credentials as $key => $value) {
            if ($value != $user->$key) {
                return false;
            }
        }

        return true;
    }
}