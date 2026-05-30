<?php

namespace App\Core\Session;
session_start();

class Session
{

    public static function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }
    public static function set(string $key, string|array $value)
    {
        $_SESSION[$key] = $value;
    }
    public static function flash(string $key)
    {
        if (isset($_SESSION[$key])) {
            $value = $_SESSION[$key];
            unset($_SESSION[$key]);
            return $value;
        }

        return null;
    }
    public static function remove(string $key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
    public static function removeAll()
    {
        // session_unset();
        session_destroy();
    }
    public static function getAll()
    {
        return $_SESSION;
    }
    public static function check(string $key): bool
    {
        if (isset($_SESSION[$key])) {
            return true;
        }
        return false;
    }
    public static function get_message(array $message)
    {
        if (isset($message)) {
            $type = $message["type"];
            $text = $message["message"];
            echo "<div class='{$type}-message'>{$text}</div>";
        }
    }

    
}
