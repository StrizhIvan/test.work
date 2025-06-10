<?php

namespace App\Core;

class Session
{
    public function __construct()
    {
        session_start();
    }

    public function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }
    public function get($key, $default = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    public function setFlash(string $key, $value) {
         $_SESSION['flash'][$key] = $value;
    }

    public function remove(string $key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public function has(string $key)
    {
        return isset($_SESSION[$key]);
    }


}