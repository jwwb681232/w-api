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
        });
    });

});