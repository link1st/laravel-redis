# laravel-redis
laravel-redis，本laravel包使用的是**PHPRedis 需要开启Redis扩展才能使用**,非~~predis~~

能提升代码执行效率，对应常见的**string**类型的get和set方法支持数组

配置**laravel-ide-helper**一起使用有代码提示

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


## 使用
- **默认reids连接**
```
// set 第二个参数可以为数组 第三个参数为ttl时间，默认不设置过期时间
\RedisCache::set('name',['name'=>'小米']);

// get 返回一个数组
\RedisCache::get('name');

```

- **切换redis连接**

```
// - 需要提前在 redis_cache.php 配置redis连接
\RedisCache::openRedis('redis_config1')->get('name'));


$redis = \RedisCache::openRedis('redis_config1');
$redis->get('name');
```


