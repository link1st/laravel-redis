<?php

namespace link1st\RedisCache\App;

use Config;

/**
 * Class RedisCache
 * @package link1st\RedisCache\App
 */
class RedisCache
{

    private $config;

    private $error;


    /**
     * 构造函数
     *
     * RedisCache constructor.
     */
    public function __construct()
    {
        $this->config = Config::get('redis_cache');
    }


    /**
     * 返回错误信息
     *
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }


    /**
     * redis连接
     *
     * @param string $type
     *
     * @return bool|RedisCluster|RedisLink
     */
    public function openRedis($type = null)
    {

        if (empty($type)) {
            $type = ! empty($this->config['default']) ? $this->config['default'] : 'default';
        }

        // 避免同一个连接redis重复连接
        if ( ! empty($this->$type)) {
            return $this->$type;
        }

        // 获取redis连接配置项
        $config = $this->config['connections'][$type];

        $config_redis = [
            'ip'            => isset($config['redis_host']) ? $config['redis_host'] : '',
            'port'          => isset($config['redis_port']) ? $config['redis_port'] : '',
            'auth'          => isset($config['redis_password']) ? $config['redis_password'] : '',
            'timeout'       => isset($config['redis_timeout']) ? $config['redis_timeout'] : 3.0,
            'persistent'    => isset($config['redis_persistent']) ? $config['redis_persistent'] : true,
            'redis_cluster' => isset($config['redis_cluster']) ? $config['redis_cluster'] : false,
            'clusters'      => isset($config['redis_clusters']) ? $config['redis_clusters'] : [],
        ];

        if ($config_redis['redis_cluster'] === true) {
            try {
                $link = new RedisCluster(null, $config_redis['clusters'], $config_redis['timeout'],
                    $config_redis['timeout']);

            } catch (\Exception $e) {
                $this->error = $e->getMessage();
                $link        = false;
            }
        } else {
            $link = RedisLink::link($config_redis['ip'], $config_redis['port'], $config_redis['auth'],
                $config_redis['timeout'], $config_redis['persistent']);
        }

        if ( ! empty($link)) {
            $this->$type = $link;
        }

        return $link;
    }

}
