<?php

namespace App\Services;

use App\Interfaces\PermissionsValidatorInterface;
use App\User_coordinator;

class PermissionsValidator implements PermissionsValidatorInterface{

    protected $user_coordinator;

    public function __construct(){
        $this->user_coordinator=new User_coordinator();
    }
    public function belongs_to_coordinator($coordinator_id, $subordinate_id){
       
        if($this->user_coordinator->subordinator_user($coordinator_id, $subordinate_id)->first())
            return true;
        else return false;
    }
}