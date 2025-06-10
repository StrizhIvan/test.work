<?php

namespace App;

use App\Core\View;
use App\Core\Session;
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
    protected $config;
    protected $session;
    protected $validation;
    public function __construct($config)
    {
        $this->config = $config;
        $this->session = new Session();
        $this->validation = new Validation();
        $this->registration = new Registration($config);
        $this->registerController = new RegisterController($this->registration, $this->validation, $this->session);

        $this->auth = new Login($config);
        $this->autherisationController = new AutherisationController($this->auth);
    }
    public function run()
    {
        Route::dispatch();
    }
}