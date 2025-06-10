<?php

namespace App\Application\Models;

use App\Core\Model;

class Login extends Model
{
    protected $table = "users";
    protected $fillable = [];

    public function loginUser()
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        if ($this->searchUser($login, 'email') || $this->searchUser($login, 'tel')) {
            $user = $this->searchUser($login, 'email') ? $this->searchUser($login, 'email') : $this->searchUser($login, 'tel');
            if (password_verify($password, $user['password'])) {
                return true;
            } else {
                return false;
            }
        }
    }
    private function searchUser(string $value, string $column)
    {
        return $this->findOne($this->table, $value, $column);
    }

}