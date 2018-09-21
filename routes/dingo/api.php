<?php

$api = app(Dingo\Api\Routing\Router::class);

$api->version('v1',function ($api) {
    $api->group(['prefix'=>'managers'],function ($api){
        //注册
        $api->post('auth/register', 'App\Api\V1\Managers\Controllers\AuthController@register');
        //登录
        $api->post('auth/login','App\Api\V1\Managers\Controllers\AuthController@login');
        //测试X-RateLimit
        $api->get('auth/test','App\Api\V1\Managers\Controllers\AuthController@test')->middleware('api','throttle:60,1');
    });

});