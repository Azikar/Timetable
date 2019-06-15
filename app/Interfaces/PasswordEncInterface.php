<?php

namespace App\Interfaces;


interface PasswordEncInterface{

    public function hash($password);
    public function verify($password, $hash);
}
