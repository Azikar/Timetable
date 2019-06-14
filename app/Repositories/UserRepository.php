<?php

namespace App\Repositories;


use App\Interfaces\UserInterface;
use App\User;
use App\Interfaces\PasswordEncInterface;


class UserRepository implements UserInterface{

    protected $user;
    protected $passwordHasher;

    public function __construct(PasswordEncInterface $passwordHasher)
    {
        $this->user=new User();
        $this->passwordHasher=$passwordHasher;
    }
    public function get_user_by_email($email){

    }
    public function create_user($data){
        
    }
    public function create_coordinator( $data){
        $this->user->fill($data->all());
        $this->user->password=$this->passwordHasher->hash($this->user->password);
        $this->user->save();
    }
    public function update_user_data($data){
        
    }
}