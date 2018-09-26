<?php

$api = app(Dingo\Api\Routing\Router::class);

$api->version('v1',function ($api) {
    $api->group(['middleware'=>['cross'],'prefix'=>'managers'],function ($api){
        //测试X-RateLimit
        //$api->get('auth/test','App\Api\V1\Managers\Controllers\AuthController@test')->middleware('api','throttle:60,1');
        //注册
        $api->post('auth/register', 'App\Api\V1\Managers\Controllers\AuthController@register');
        //登录
        $api->post('auth/login','App\Api\V1\Managers\Controllers\AuthController@login');

        $api->group(['middleware'=>'auth.jwt:manager'], function($api) {
            //管理员个人信息
            $api->get('auth/info','App\Api\V1\Managers\Controllers\AuthController@info');
            //登出
            $api->post('auth/logout','App\Api\V1\Managers\Controllers\AuthController@logout');

            //<editor-fold desc="后台菜单">
            //创建后台菜单
            $api->post('admin-menus','App\Api\V1\Managers\Controllers\AdminMenuController@store');
            //删除后台菜单
            $api->delete('admin-menus/{id}','App\Api\V1\Managers\Controllers\AdminMenuController@destroy');
            //更新后台菜单
            $api->patch('admin-menus/{id}','App\Api\V1\Managers\Controllers\AdminMenuController@update');
            //后台菜单列表
            $api->get('admin-menus','App\Api\V1\Managers\Controllers\AdminMenuController@index');
            //</editor-fold>

            //<editor-fold desc="角色">
            //创建角色
            $api->post('roles','App\Api\V1\Managers\Controllers\RoleController@store');
            //删除角色
            $api->delete('roles/{id}','App\Api\V1\Managers\Controllers\RoleController@destroy');
            //更新角色
            $api->patch('roles/{id}','App\Api\V1\Managers\Controllers\RoleController@update');
            //角色列表
            $api->get('roles','App\Api\V1\Managers\Controllers\RoleController@index');
            //</editor-fold>

            //<editor-fold desc="权限">
            //创建权限
            $api->post('permissions','App\Api\V1\Managers\Controllers\PermissionController@store');
            //删除权限
            $api->delete('permissions/{id}','App\Api\V1\Managers\Controllers\PermissionController@destroy');
            //更新权限
            $api->patch('permissions/{id}','App\Api\V1\Managers\Controllers\PermissionController@update');
            //权限列表
            $api->get('permissions','App\Api\V1\Managers\Controllers\PermissionController@index');
            //</editor-fold>
        });
    });

});