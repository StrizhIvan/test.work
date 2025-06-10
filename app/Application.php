<?php

namespace App;

use App\Application\Middleware;
use App\Core\View;
use App\Core\Session;
use App\Application\Captcha;
use App\Application\Validation;
use App\Application\Models\Login;
use App\Application\Router\Route;
use App\Application\Models\Registration;
use App\Application\Controllers\RegisterController;
use App\Application\Controllers\AutherisationController;

class Application
{
    protected $registration;
    protected $registerController;
    protected $auth;
    protected $autherisationController;
    protected $router;
    protected $middleware;
    protected $config;
    protected $session;
    protected $validation;
    protected $captcha;
    public function __construct($config)
    {
        $this->config = $config;
        $this->session = new Session();
        $this->validation = new Validation();
        $this->captcha = new Captcha();
        $this->middleware = new Middleware($this->session);
        $this->router = new Route($this->middleware);
        $this->registration = new Registration($config);
        $this->registerController = new RegisterController($this->registration, $this->validation, $this->session);

        $this->auth = new Login($config);
        $this->autherisationController = new AutherisationController($this->auth, $this->session, $this->captcha, $this->validation);
    }
    public function run()
    {   
        Route::dispatch();
    }
}