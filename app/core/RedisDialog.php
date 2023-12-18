<?php
/**
 * Класс кэша данных.
 */
namespace core;

class RedisDialog
{   
    /** @var string конфиг редиски */
    private $config;
    /** @var string коннект редиски */
    private static $redis;
    

    /**
     * Конструктор.
     */
    public function __construct(array $config)
    {   
        if (extension_loaded('redis')) {
            static::$redis = new \Redis();
        } else {
            static::$redis = new Jammer();
        }
        $this->config = $config;
    }
    private function connect(){
        if (!static::$redis->isConnected()) {
            static::$redis->connect(
                $this->config['host'],
                $this->config['port'],
                $this->config['timeout'],
                '',
                $this->config['retry_interval'],
                $this->config['read_timeout'],
            );
            static::$redis->select($this->config['db']);
        }
    }
    public function clearKey(string $key){
        $this->connect();
        static::$redis->del($this->config['prefix'].$key);
    }
    public function expireKey(string $key, int $seconds = 10){
        $this->connect();
        static::$redis->expire($this->config['prefix'].$key, $seconds);
    }
    public function addSerialisedTTL(string $key, mixed $data, int $seconds = 10){
        $this->connect();
        if (extension_loaded('igbinary')) {
            return static::$redis->set($this->config['prefix'].$key, igbinary_serialize($data), [ 'ex' => $seconds]);
        }
        return static::$redis->set($this->config['prefix'].$key, serialize($data), [ 'ex' => $seconds]);
    }
    public function addSerialised(string $key, mixed $data){
        $this->connect();
        if (extension_loaded('igbinary')) {
            return static::$redis->set($this->config['prefix'].$key, igbinary_serialize($data));
        }
        return static::$redis->set($this->config['prefix'].$key, serialize($data));
    }
    public function getSerialised(string $key){
        $this->connect();
        if (extension_loaded('igbinary')) {
            return igbinary_unserialize(static::$redis->get($this->config['prefix'].$key));
        }
        return unserialize(static::$redis->get($this->config['prefix'].$key));
    }
    public function addToList(string $key, ...$values){
        $this->connect();
        static::$redis->rPush($this->config['prefix'].$key, ...$values);
    }
    public function lengthList(string $key){
        $this->connect();
        return static::$redis->lLen($this->config['prefix'].$key);
    }
    public function getList(string $key, int $from = 0, int $to = -1){
        $this->connect();
        return static::$redis->lRange($this->config['prefix'].$key, $from, $to);
    }
    
}
class Jammer{
    function connect(...$args){}
    function select(...$args){}
    function isConnected(){return false;}
    function set(...$args){return false;}
    function get(...$args){return false;}
    function expire(...$args){}
    function del(...$args){}
    function rPush(...$args){}
    function lLen(...$args){return 0;}
    function lRange(...$args){return [];}
}