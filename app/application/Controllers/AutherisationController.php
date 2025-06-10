<?php

namespace App\Application\Controllers;

use App\Core\Controller;
use App\Application\Models\Login;


class AutherisationController extends Controller
{

    private static $login;
    public function __construct(Login $login)
    {
        self::$login = $login;
    }

    public static function show()
    {
        return self::view('login');
    }

    public static function login()
    {
        var_dump(self::$login->loginUser());
    }
}