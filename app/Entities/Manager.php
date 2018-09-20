<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/9/20
 * Time: 21:05
 */

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    /**
     * 表名
     *
     * @var string
     */
    //protected $table = 'admins';


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
            'updated_at',
            'type',
            'has_employer',
            'registration_id',
            'status',
        ];

}