<?php

namespace App\Application\Models;

use App\Core\Model;

class Registration extends Model{
    protected $table = "users";
    public array $fillable;

    public function addUser () {
        //$this->fillable = $_POST;
        //$name = $_POST['name'];
        //$email = $_POST['email'];
        //$tel = $_POST['tel'];
        //$password = $_POST['password'];
        if($this->searchUser($this->fillable['email'], 'email') || $this->searchUser($this->fillable['tel'], 'tel')){
            return false;
        } else {
            $password = password_hash($this->fillable['password'], PASSWORD_DEFAULT);
            $this->insert($this->table, [$this->fillable['name'], $this->fillable['email'], $this->fillable['tel'], $password], ['name', 'email', 'tel', 'password']);
            return true;
        }
    }

    
    private function hashPassword(string $password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    private function searchUser(string $value, string $column) {
        return $this->findOne($this->table, $value, $column);
    }
}