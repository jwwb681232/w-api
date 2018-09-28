<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/9/20
 * Time: 21:05
 */

namespace App\Entities;

use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Manager extends Authenticatable implements JWTSubject
{
    use HasRoles;
    /**
     * 表名
     *
     * @var string
     */
    //protected $table = 'admins';


    protected $guard = 'manager';


    /**
     * 主键
     *
     * @var string
     */
    protected $primaryKey = 'id';


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden
        = [
            'password',
        ];

    /**
     * @var array
     */
    protected $fillable
        = [
            'name',
            'email',
            'password',
            'remember_token',
            'created_at',
            'updated_at'
        ];

    /**
     * 获取主键
     * @return string
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * 返回一个键值数组，其中包含要添加到JWT的任何自定义声明。
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}