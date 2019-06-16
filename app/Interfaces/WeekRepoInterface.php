<?php

namespace App\Interfaces;

interface WeekRepoInterface{

    public function create_Week_at_start($coordinator_id, $id);
    public function create_Week_at_end($coordinator_id, $id);
    public function get_User_Weeks($coordinator_id, $id);
    public function get_Last_week($id);
    public function get_First_week($id);
    public function delete_First_week($coordinator_id, $id);
    public function delete_Last_week($coordinator_id, $id);
    public function get_week_by_id($id);
    public function get_user_timetable($coordinator_id, $id);

}