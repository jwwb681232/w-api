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
    public function register($request)
    {
        $data['name']     = $request->name;
        $data['email']    = $request->email;
        $data['password'] = bcrypt($request->password);
        if ($manager = $this->create($data)) {
            $token = auth('manager')->attempt(['id' => $manager->id]);
            return ['manager'=>$manager,'token'=>$token];
        }
        throw new ValidatorException(new MessageBag(['Http Exception']));
    }
}