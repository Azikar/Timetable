<?php

namespace App\Repositories;


use App\Interfaces\SubordinatesInterface;
use App\User;



class SubordinatesRepository implements SubordinatesInterface{

    public function __construct(){
       $this->user=new User(); 
    }

    // could use redis to save list for further calls
    public function UserSubordinates($user){
        return $user->subordinates()->select('name','email','id')->get();
    }
}