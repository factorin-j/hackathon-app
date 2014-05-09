<?php

class Session
{
    public static function start()
    {
        session_start();
    }

    public static function stop()
    {
        session_unset();
        session_destroy();
    }

    public static function get($key, $default = null)
    {
        return self::has($key) ? $_SESSION[$key] : $default;
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function has($key)
    {
        return array_key_exists($key, $_SESSION);
    }

    public static function delete($key)
    {
        unset($_SESSION[$key]);
    }

    public static function reset()
    {
        $_SESSION = array();
    }
}
