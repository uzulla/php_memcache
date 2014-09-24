<?php
namespace Uzulla\Memcache;

class Session implements \SessionHandlerInterface {

    private $mc;
    private $lifetime;
    static $prefix = "php_sess_";

    public function __construct($host, $port) {
        $this->mc = new SimpleStore($host, $port);
    }
    public function open($save_path, $name) {
        return true;
    }
    public function close() {
        $this->mc->close();
        return true;
    }
    public function read($session_id) {
        $data = $this->mc->get(static::$prefix.$session_id);
        return $data;
    }
    public function write($session_id, $session_data) {
        $res = $this->mc->set(static::$prefix.$session_id, $session_data, false, $this->lifetime);
        return $res;
    }
    public function destroy($session_id) {
        $this->mc->delete($session_id);
        return true;
    }
    public function gc($maxlifetime) {
        return true;
    }
}
