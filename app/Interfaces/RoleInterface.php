<?php

namespace App\Interfaces;

interface RoleInterface{

    public function getRoles();
   
    public function getCoordinatorRole();

    public function getUserRole();
}