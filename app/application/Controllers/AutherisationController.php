<?php

namespace App\Application\Controllers;

use App\Core\Session;
use App\Core\Controller;
use App\Application\Captcha;
use App\Application\Validation;
use App\Application\Models\Login;


class AutherisationController extends Controller
{
    
    private static $login;
    private static $session;
    private static $captcha;
    private static $validation;
    public function __construct(Login $login, Session $session, Captcha $captcha, Validation $validation)
    {
        self::$login = $login;
        self::$session = $session;
        self::$captcha = $captcha;
        self::$validation = $validation;
    }

    public static function show()
    {

        if (self::$session->has("user")) {
            self::redirect('profil');
            return;
        }
        
        return [self::view('login'), self::$session->remove('flash')];
    }

    public static function login()
    {
        self::$login->fillable = [
            'login' => $_POST['login'],
            'password' => $_POST['password']  
        ];

        $validationErrors = self::searchValidationErrors(self::$login->fillable);
        if (!empty($validationErrors)) {
            self::$session->setFlash('Empty fields', $validationErrors);
            self::redirect('/');
            die;
        }
        
        $token = $_POST["smart-token"];
        $captchaResult = self::$captcha->checkCaptcha($token);
        if (!$captchaResult) {
            self::$session->setFlash('Captcha error', 'Заполните капчу');
            self::redirect();
            die;
        }
        
        
        
        if (self::$login->loginUser()) {
            self::$session->set('user', self::$login->loginUser());
            self::redirect('/profil');
        } else {
            self::$session->setFlash('Login error', 'Неверный логин или пароль');
            self::redirect();
            die;
        }
        
    }

    private static function hasRequired(array $fields)
    {
        foreach ($fields as $key => $value) {
            self::$validation->required($key, $value);
        }

    }

    private static function searchValidationErrors(array $fillable)
    {
        self::hasRequired($fillable);
        return self::$validation->errors();
    }
}

