<?php
/* sample */

require_once('vendor/autoload.php');
$session_handler = new \Uzulla\Memcache\Session('127.0.0.1',11211);

session_set_save_handler($session_handler);

$_SESSION['test'] = 'this is test';

$mc = new \Uzulla\Memcache\SimpleStore('127.0.0.1',11211);
$mc->set('hoge', 'fuge');

echo $mc->get('hoge').PHP_EOL;


