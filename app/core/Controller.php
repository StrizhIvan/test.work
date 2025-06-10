<?php

namespace App\Core;

abstract class Controller
{

    protected static function view($pageName, $data = [], $layoutName = '')
    {
        $view = new View();
        return $view->render($pageName, $data, $layoutName);
    }

    protected static function redirect(string $path)
    {
        header('Location:' . $path);
        
    }
}