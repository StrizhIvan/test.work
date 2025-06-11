<?php

namespace App\Application\Models;

use App\Core\Model;

class Profil extends Model
{
    protected $table = "users";
    public array $fillable;

    public function editUser(int $id)
    {
        $this->fillable['password'] = $this->hashPassword($this->fillable['password']);
        $this->updateById($this->table, $this->fillable, $id);
        return $this->findOne($this->table, $id, 'id');
    }

    private function hashPassword(string $password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}