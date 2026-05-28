<?php

namespace App\Core\Session;

class Session
{


    public static function setSession(string $name, string|array $value)
    {
        $_SESSION[$name] = $value;
    }
    public static function getSession(string $name)
    {

        return $_SESSION[$name] ?? null;
    }
    public static function deleteSession(string $name)
    {
        unset($_SESSION[$name]);
    }
    public static  function hasSession(string $name): bool
    {
        return isset($_SESSION[$name]);
    }
}
