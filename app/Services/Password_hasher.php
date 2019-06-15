<?php

namespace App\Services;

use App\Interfaces\PasswordEncInterface;
class Password_hasher implements PasswordEncInterface{

    public function hash($password){
        $options = [
            'cost' => 12,
        ];
        return trim(password_hash($password, PASSWORD_BCRYPT, $options));
    }
    public function verify($password, $hash){
       
        if(password_verify($password, $hash))
            return true;
        else return false;
    }
}