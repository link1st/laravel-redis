<?php

namespace link1st\RedisCache\App;

/**
 * Class RedisCluster
 * @package link1st\RedisCache\App
 * @mixin \RedisCluster
 */
class RedisCluster extends \RedisCluster
{


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
        if (parent::type($key) == self::REDIS_HASH) {
            return parent::hGetAll($key);
        }

        return null;
    }

}
