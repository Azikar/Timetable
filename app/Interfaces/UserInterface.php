<?php

namespace App\Interfaces;

interface UserInterface{

    public function get_user_by_email($email);
    public function create_user($data);
    public function create_coordinator($data);
    public function update_user_data($data);
    public function get_user_roles($id);
    public function setRole($user,$roles);
    public function delete_user($id);
    public function set_timetable_start_date($id, $date);
    public function get_User_By_id($id);

}