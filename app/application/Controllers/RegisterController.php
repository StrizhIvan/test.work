<?php

namespace App\Application\Controllers;

use App\Core\Session;
use App\Core\Controller;
use App\Application\Validation;
use App\Application\Models\Registration;

class RegisterController extends Controller
{
    private static $registration;
    private static $session;
    private static $validation;
    public function __construct( Registration $registration,  Validation $validation,  Session $session)
    {   
        self::$registration = $registration;
        self::$validation = $validation;
        self::$session = $session;

    }
    public static function show()
    {
        if (self::$session->has("user")) {
            self::redirect('profil');
            return;
        }
        
        return [self::view('register'), self::$session->remove('flash')];
    }

    public static function register()
    {
        self::$registration->fillable = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'tel' => $_POST['tel'],
            'password' => $_POST['password'],
            'passwordConfirm' => $_POST['password-confirm'],
        ];

        $errors = self::searchValidationErrors(self::$registration->fillable);
        if (!empty($errors)) {
            self::$session->setFlash('Errors validation', $errors);
            return self::redirect('/');
        }
        $result = self::$registration->addUser();
        if ($result) {
            self::$session->remove('Errors validation');
            return self::view('success');
        } else {
            return self::view('baduser');
        }

    }

    private static function hasRequired(array $fields)
    {
        foreach ($fields as $key => $value) {
            self::$validation->required($key, $value);
        }

    }

    private static function validateEmail(string $field, $value)
    {
        self::$validation->email($field, $value);
    }

    private static function validatePhoneNumber(string $field, $value)
    {
        self::$validation->phoneNumber($field, $value);
    }

    private static function passwordConfirm(string $field, $password, $passwordConform)
    {
        self::$validation->passwordConfirm($field, $password, $passwordConform);
    }

    private static function searchValidationErrors(array $fillable)
    {
        self::hasRequired($fillable);
        self::validateEmail('email', $fillable['email']);
        self::validatePhoneNumber('tel', $fillable['tel']);
        self::passwordConfirm('password-confirm', $fillable['password'], $fillable['passwordConfirm']);
        return self::$validation->errors();
    }

    //public static function searchUser(){
    //    var_dump(self::$registration->searchUser()) ;
    //}

}