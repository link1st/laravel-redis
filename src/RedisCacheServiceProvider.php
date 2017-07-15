<?php
namespace link1st\RedisCache;

use Illuminate\Support\ServiceProvider;

use link1st\RedisCache\App\LaravelKs3Client;

class Ks3ServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     * 引导程序
     *
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        // 发布配置文件 + 可以发布迁移文件
        $this->publishes([
            __DIR__.'/../config/redis_cache.php' => config_path('redis_cache.php'),
        ]);

    }


    /**
     * 默认包位置
     *
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // 将给定配置文件合现配置文件接合
        $this->mergeConfigFrom(
            __DIR__.'/../config/redis_cache.php', 'redis_cache'
        );

        // 容器绑定
        $this->app->bind('RedisCache', function () {
            return new RedisCache();
        });
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

}
