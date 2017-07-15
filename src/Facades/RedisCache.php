<?php namespace link1st\RedisCache\Facades;

use Illuminate\Support\Facades\Facade;

class RedisCache extends Facade
{

    /**
     *
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'RedisCache';
    }
}
