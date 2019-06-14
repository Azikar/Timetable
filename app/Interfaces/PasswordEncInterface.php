<?php

namespace App\Interfaces;


interface PasswordEncInterface{

    public function hash($password);
}
