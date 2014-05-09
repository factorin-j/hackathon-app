<?php
class Param
{
    const TOKEN = 'token';

    public static function getToken()
    {
        return self::has(self::TOKEN) ? md5(self::get(self::TOKEN)) : null;
    }

    public static function has($name)
    {
        return array_key_exists($name, $_REQUEST);
    }

    public static function get($name, $default = null)
    {
        return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $default;
    }

    public static function params()
    {
        return $_REQUEST;
    }

    public static function isMethod($method)
    {
        return strtolower(trim($_SERVER['REQUEST_METHOD'])) == strtolower(trim($method));
    }
}
