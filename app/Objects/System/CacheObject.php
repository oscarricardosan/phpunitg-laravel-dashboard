<?php

namespace App\Objects\System;


use App\Objects\ObjectBase;

class CacheObject extends ObjectBase
{
    protected $cache= [];


    public function __construct(array $dataInCache= [])
    {
        $this->initializeCache($dataInCache);
    }

    /**
     * @param string $nameCache
     * @return $this
     */
    public function initializeCache($defaultData= [])
    {
        $this->cache= $defaultData;
        return $this;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function exists($key)
    {
        return in_array($key, $this->cache);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        if($this->isInCache($key))
            return $this->cache[$key];
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function set($key, $value= null)
    {
        $this->cache[$key]= $value;
        return $this;
    }

    /**
     * @param string $key
     * @return boolean
     */
    private function isInCache($key)
    {
        return array_has($this->cache, $key);
    }
}