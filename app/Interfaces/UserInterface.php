<?php

namespace App\Interfaces;

interface UserInterface{

    public function get_user_by_email($email);
    public function create_user($data);
    public function create_coordinator($data);
    public function update_user_data($data);
    public function get_user_roles($id);
    public function setRole($user,$roles);


}