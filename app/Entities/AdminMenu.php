<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/23
 * Time: 10:34
 */
namespace App\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminMenu extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'name',
    ];

    protected $dates = ['deleted_at'];

    public function permissions()
    {
        return $this->hasMany(Permission::class,'menu_id');
    }
}