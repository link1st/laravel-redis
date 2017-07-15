# laravel-redis
laravel-redis

## 安装
加载包

`"link1st/laravel-redis": "dev-master"`

或

`composer require link1st/laravel-redis`

在配置文件中添加 **config/app.php**

```php
    'providers' => [
        /**
         * 添加供应商
         */
        link1st\RedisCache\RedisCacheServiceProvider::class,
    ],
    'aliases' => [
         /**
          * 添加别名
          */
        'RedisCache' => link1st\RedisCache\Facades\RedisCache::class,
    ],
```

生成配置文件

`php artisan vendor:publish`

设置参数 **config/redis_cache.php**



