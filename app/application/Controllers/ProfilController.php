<?php 

namespace App\Application\Controllers;

use App\Core\Controller;

class ProfilController extends Controller {

    public static function show() {
        return self::view("profil");
    }
}