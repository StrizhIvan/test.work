<?php

namespace App\Application\Models;

use App\Core\Model;

class Login extends Model
{
    protected $table = "users";
    public array $fillable;

    public function loginUser(): array|bool
    {

        $user = null;
        if ($this->searchUser($this->fillable['login'], 'email')) {
            $user = $this->searchUser($this->fillable['login'], 'email');
        } elseif ($this->searchUser($this->fillable['login'], 'tel') ) {
            $user = $this->searchUser($this->fillable['login'], 'tel');
        }
        if ($user && password_verify($this->fillable['password'], $user['password'])) {
            return $user;
        }

        return false;
    }
    private function searchUser(string $value, string $column) :array|bool
    {
        return $this->findOne($this->table, $value, $column);
    }

    

}