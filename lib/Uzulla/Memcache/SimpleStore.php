<?php
namespace Uzulla\Memcache;
//http://php.net/manual/ja/book.memcache.php

class SimpleStore {
    /** @var \Memcache */
    static $mc=null;
    private $prefix;
    private $lifetime;

    public function __construct($host, $port, $prefix='', $lifetime=86400) {
        $mc = new \Memcache();
        $mc->pconnect($host, $port);
        static::$mc = $mc;
        $this->prefix = $prefix;
        $this->lifetime = $lifetime;
    }

    public function close() {
        return static::$mc = null;
    }

    public function get($key) {
        return static::$mc->get($this->prefix.$key);
    }

    public function set($key, $val) {
        return static::$mc->set($this->prefix.$key, $val, false, $this->lifetime);
    }

    public function delete($key) {
        return static::$mc->delete($this->prefix.$key);
    }

    public function flush(){
        return static::$mc->flush();
    }
}
