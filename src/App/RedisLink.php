<?php

namespace link1st\RedisCache\App;

/**
 * Class RedisLink
 * @package link1st\RedisCache\App
 * @mixin \Redis
 */
class RedisLink extends \Redis
{

    /**
     * redis连接
     *
     * @param string $host       地址
     * @param int    $port       端口
     * @param string $auth       密码
     * @param int    $timeout    连接时间 3秒
     * @param bool   $persistent 是否持久化
     *
     * @return \Redis|bool
     */
    public static function link($host, $port = 3306, $auth = '', $timeout = 3, $persistent = false)
    {

        $redis_cache = new RedisLink();
        // 连接时间必须是数字
        if ( ! is_numeric($timeout) || empty($timeout)) {
            $timeout = 0.0;
        }

        if ($persistent === false) {
            // 非持久化
            $connect_return = $redis_cache->connect($host, $port, $timeout);
        } else {

            $connect_return = $redis_cache->pconnect($host, $port, $timeout);
        }

        if ($connect_return === false) {
            return false;
        }

        // 身份验证
        if ( ! empty($auth)) {
            // 验证失败
            if ($redis_cache->auth($auth) === false) {
                return false;
            }
        }

        return $redis_cache;
    }


    /**
     * 读取缓存
     * @access public
     *
     * @param string $name 缓存变量名
     *
     * @return mixed
     */
    public function get($name)
    {
        $value    = parent::get($name);
        $jsonData = json_decode($value, true);

        //检测是否为JSON数据 true 返回JSON解析数组, false返回源数据
        return ($jsonData === null) ? $value : $jsonData;
    }


    /**
     * 写入缓存
     * @access public
     *
     * @param string  $name   缓存变量名
     * @param mixed   $value  存储数据
     * @param integer $expire 有效时间（秒）
     *
     * @return boolean
     */
    public function set($name, $value, $expire = null)
    {
        if (is_null($expire)) {
            $expire = 0;
        }
        //对数组/对象数据进行缓存处理，保证数据完整性
        $value = (is_object($value) || is_array($value)) ? json_encode($value) : $value;
        if (is_int($expire) && $expire) {
            $result = parent::setex($name, $expire, $value);
        } else {
            $result = parent::set($name, $value);
        }

        return $result;
    }


    /**
     * fix hGetAll bug (hash is empty)
     *
     * @param string $key
     *
     * @return array
     */
    public function hGetAll($key)
    {
        // parent::exists($key))
        if (parent::type($key) == self::REDIS_HASH) {
            return parent::hGetAll($key);
        }

        return null;
    }

}
