<?php


class Session
{
    protected static $_started = false;

    public static function start()
    {
        if (false === self::$_started)
        {
            session_start();
            self::$_started = true;
        }
    }

    public static function get($key)
    {
        return $_SESSION[$key];
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function display()
    {
        echo '<pre>';
        var_dump($_SESSION);
        echo '</pre>';
    }

    public static function destroy()
    {
        if (self::$_started == true) {
            $_SESSION = array();

            setcookie(session_name(), "", time() - 42000, "/");

            session_destroy();
        }
    }
}