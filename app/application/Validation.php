<?php 

namespace App\Application;

class Validation {
    private $errors = [];

    public function required($fieldname, $value) {
        if(empty($value)) {
            $this->errors[$fieldname] = "Поле обязательно для заполнения";
        }

    }
    public function email(string $fieldname, $value) {
        if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$fieldname] = "Неправильно введен email";
        }
    }

    public function phoneNumber(string $fieldname, $value) {
        $pattern = "/^(\+7|8)?\s?\(?\d{3}\)?[\s-]?\d{3}[\s-]?\d{2}[\s-]?\d{2}$/";
        if(!preg_match($pattern, $value)) {
            $this->errors[$fieldname] = "Неправильно введен номер телефона";
        }
    }

    public function password(string $fieldname, $value) {
        //$pattern = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";
        $pattern = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/";
        if(preg_match($pattern, $value) == 0) {
            $this->errors[$fieldname] = "Неверно составлен пароль: мин. длина 8 символов, используйте латинские буквы разного регистра и хотя бы 1 цифру.";
        } else {
         $this->errors[$fieldname] = $value;
        }
    }
    
    public function passwordConfirm(string $fieldname, $value, $valueConfirm) {
        if ($value != $valueConfirm) { 
            $this->errors[$fieldname] = "Пароли не совпадают";
        }
    }

    public function errors() {
        return $this->errors;
    }
}