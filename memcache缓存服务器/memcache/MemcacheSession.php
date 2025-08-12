<?php

class MemcacheSession {
	// memcache对象
    private static $handler  = null;
	// 过期时间 秒
    private static $lifetime = null;
	// 当前时间
    private static $time     = null;
	// session名前缀
    const NS = 'wwwzfwcom_';

    // 初始化
    private static function init(Memcache $handler) {
        self::$handler = $handler;
        self::$lifetime = 1440;
        self::$time = time();
    }

    // 外部调用初始化
    public static function start(Memcache $memcache) {
        self::init($memcache);

        // 自定义session存储介质
        session_set_save_handler(
            array(__CLASS__, 'open'),
            array(__CLASS__, 'close'),
            array(__CLASS__, 'read'),
            array(__CLASS__, 'write'),
            array(__CLASS__, 'destroy'),
            array(__CLASS__, 'gc')
        );
        session_start();
    }

    public static function open($path, $name) {
        return true;
    }

    public static function close() {
        return true;
    }

    public static function read($id) {
        $out = self::$handler->get(self::session_key($id));

        if ($out === false || $out == null)
            return '';

        return $out;
    }

    public static function write($id, $data) {

        $method = $data ? 'set' : 'replace';

        return self::$handler->$method(self::session_key($id), $data, MEMCACHE_COMPRESSED, self::$lifetime);
    }

    public static function destroy($id) {
        return self::$handler->delete(self::session_key($id));
    }

    public static function gc($lifetime) {
        return true;
    }

    private static function session_key($id) {
        $session_key = self::NS . $id;

        return $session_key;
    }
}

$memcache = new Memcache;
$memcache->connect("140.143.30.117", 11211);
MemcacheSession::start($memcache);


