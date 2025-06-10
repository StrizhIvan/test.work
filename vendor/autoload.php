<?php

spl_autoload_register(function ($class) {
    $filename = str_replace("\\","/", $class) .".php";
    require_once $filename;
});