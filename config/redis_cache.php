<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 默认的redis连接池
    |--------------------------------------------------------------------------
    */
    'default'     => env('REDIS_CONNECTION', 'default'),

    /*
    |--------------------------------------------------------------------------
    | 连接池
    |--------------------------------------------------------------------------
    */
    'connections' => [

        'default' => [
            /*
            |--------------------------------------------------------------------------
            | redis 地址
            |--------------------------------------------------------------------------
            */
            'redis_host'       => env('REDIS_HOST', '127.0.0.1'),

            /*
            |--------------------------------------------------------------------------
            | redis 连接端口
            |--------------------------------------------------------------------------
            */
            'redis_port'       => env('REDIS_PORT', '6379'),

            /*
            |--------------------------------------------------------------------------
            | redis密码 可以为空
            |--------------------------------------------------------------------------
            */
            'redis_password'   => env('REDIS_PASSWORD', null),

            /*
            |--------------------------------------------------------------------------
            | redis连接超时时间
            |--------------------------------------------------------------------------
            */
            'redis_timeout'    => env('REDIS_TIMEOUT', 0.0),

            /*
            |--------------------------------------------------------------------------
            | 是否持久化
            |--------------------------------------------------------------------------
            */
            'redis_persistent' => env('REDIS_PERSISTENT', true),
        ],

    ],

];
