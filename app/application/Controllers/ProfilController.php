<?php

namespace App\Application\Controllers;

use App\Core\Session;
use App\Core\Controller;
use App\Application\Validation;
use App\Application\Models\Profil;

class ProfilController extends Controller
{
    private static $profil;
    private static $validation;
    private static $session;

    public function __construct(Profil $profil, Validation $validation, Session $session)
    {
        self::$profil = $profil;
        self::$validation = $validation;
        self::$session = $session;
    }
    public static function show()
    {
        return [self::view("profil"), self::$session->remove('flash')];

    }

    public static function edit()
    {
        self::$profil->fillable = [
            'name' => !empty($_POST['name']) ? $_POST['name'] : self::$session->get('user')['name'],
            'email' => !empty($_POST['email']) ? $_POST['email'] : self::$session->get('user')['email'],
            'tel' => !empty($_POST['tel']) ? $_POST['tel'] : self::$session->get('user')['tel'],
            'password' => !empty($_POST['password']) ? $_POST['password'] : self::$session->get('user')['password'],
        ];

        $errors = self::searchValidationErrors(self::$profil->fillable);

        if (!empty($errors)) {
            self::$session->setFlash('Errors', $errors);
            return self::redirect();
        }

        $changedUser = self::$profil->editUser(self::$session->get('user')['id']);
        self::$session->remove('user');
        self::$session->set('user', $changedUser);
        return self::redirect();

    }

    public static function logout() {
        self::$session->remove('user');
        return self::redirect('/');
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

    private static function searchValidationErrors(array $fillable)
    {
        self::hasRequired($fillable);
        self::validateEmail('email', $fillable['email']);
        self::validatePhoneNumber('tel', $fillable['tel']);
        return self::$validation->errors();
    }
}