<?php

namespace App\Repositories;


use App\Interfaces\RoleInterface;
use App\Role;



class RoleRepository implements RoleInterface{

    public function __construct(){
       $this->role=new Role(); 
    }

    public function getRoles(){
        return $this->role->get();
    }
    public function getCoordinatorRole(){
        return $this->role->where('title','_coordinator_')->first();
    }
    public function getUserRole(){
        return $this->role->where('title','_user_')->first();
    }
}