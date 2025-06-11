<?php

namespace App\Core;

abstract class Controller
{

    protected static function view($pageName, $data = [], $layoutName = '')
    {
        $view = new View();
        return $view->render($pageName, $data, $layoutName);
    }

    protected static function redirect(string $path = null)
    {
        if (isset($path)) {
            header('Location: ' . $path);
            exit;
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

    }
}