<?php

namespace link1st\RedisCache\App;

use Config;

class RedisCache
{

    private $config;


    /**
     * 构造函数
     *
     * LaravelKs3Client constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $config   = Config::get('redis_cache');
        dump($config);
    }



    public function test()
    {
        return 'test';
    }

}
