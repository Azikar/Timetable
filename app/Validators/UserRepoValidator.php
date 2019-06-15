<?php
namespace App\Validators;

class UserRepoValidator{

    public $createCoordinatorRules=[
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required'];
        
    public $loginRules=[
        'email' => 'required|email',
        'password' => 'required'];
}