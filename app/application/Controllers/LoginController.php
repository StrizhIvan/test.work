<?php 

namespace App\Application\Controllers;

use App\Core\Controller;
use App\Application\Models\Login;

class LoginController extends Controller {
    private static $login;
    public function __construct(Login $login) {
        $this->login = $login;
    }
    public static function login() {}
}