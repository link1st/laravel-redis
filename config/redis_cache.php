<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 授权密钥
    |--------------------------------------------------------------------------
    */
    'ks3_access_key' => env('KS3_ACCESS_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | secret key
    |--------------------------------------------------------------------------
    */
    'ks3_secret_key' => env('KS3_SECRET_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | bucket名称
    |--------------------------------------------------------------------------
    */
    'ks3_bucket'     => env('KS3_BUCKET', ''),

    /*
    |--------------------------------------------------------------------------
    | end_point
    |--------------------------------------------------------------------------
    */
    'ks3_end_point'  => env('KS3_END_POINT', ''),

    /*
    |--------------------------------------------------------------------------
    |  是否使用VHOST
    |--------------------------------------------------------------------------
    */
    'vhost'          => true,

    /*
    |--------------------------------------------------------------------------
    |  是否开启日志(写入日志文件)
    |--------------------------------------------------------------------------
    */
    'log'            => false,

    /*
    |--------------------------------------------------------------------------
    |  是否显示日志(直接输出日志)
    |--------------------------------------------------------------------------
    */
    'display_log'    => false,

    /*
    |--------------------------------------------------------------------------
    | 定义日志目录(默认是该项目log下)
    |--------------------------------------------------------------------------
    */
    'log_path'       => '',

    /*
    |--------------------------------------------------------------------------
    | 是否使用HTTPS
    |--------------------------------------------------------------------------
    */
    'use_https'      => false,

    /*
    |--------------------------------------------------------------------------
    | 是否开启curl debug模式
    |--------------------------------------------------------------------------
    */
    'debug_mode'     => false,

];