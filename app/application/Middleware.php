<?php 

namespace App\Application;

use App\Core\Session;

class Middleware {
    private $session;
    public function __construct(Session $session) {
        $this->session = $session;
    }

    public function authMiddleware() {
        
        if($this->session->has("user")) {
            return true;
        } else {
            return false;
        }
    }
}