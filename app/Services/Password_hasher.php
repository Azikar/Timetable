<?php

namespace App\Services;

use App\Interfaces\PasswordEncInterface;
class Password_hasher implements PasswordEncInterface{

    public function hash($password){
        $options = [
            'cost' => 12,
        ];
        return password_hash($password, PASSWORD_BCRYPT, $options);
    }
}