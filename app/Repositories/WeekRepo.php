<?php

namespace App\Repositories;


use App\Interfaces\WeekRepoInterface;
use App\Week;
use App\Interfaces\PermissionsValidatorInterface;
use App\Interfaces\dateCalculatorInterface;
use App\Interfaces\UserInterface;


class WeekRepo implements WeekRepoInterface{

    public function __construct(PermissionsValidatorInterface $permvalidate,
     dateCalculatorInterface $dateCalc, UserInterface $userRepo){
       $this->Week=new Week();
       $this->permvalidate=$permvalidate;
       $this->dateCalc=$dateCalc;
       $this->userRepo=$userRepo;
    }
    public function create_Week_at_start($coordinator_id, $id){
        if($this->permvalidate->belongs_to_coordinator($coordinator_id, $id)){
            $firsts_week=$this->get_First_week($id);
            if($this->get_First_week($id))
                $new_dates=$this->dateCalc->sub_Week($firsts_week->start);
            else {
                $user=$this->userRepo->get_User_By_id($id);
                $new_dates=$this->dateCalc->sub_Week($user->start_date);
            }
            $this->Week->start=$new_dates['start'];
            $this->Week->end=$new_dates['end'];
            $this->Week->user_id=$id;
            $this->Week->save();
            return $this->Week;
            
        }
    }
    public function create_Week_at_end($coordinator_id, $id){
        if($this->permvalidate->belongs_to_coordinator($coordinator_id, $id)){
            $firsts_week=$this->get_Last_week($id);
            if($this->get_Last_week($id))
                $new_dates=$this->dateCalc->add_Week($firsts_week->start);
            else {
                $user=$this->userRepo->get_User_By_id($id);
                $new_dates=$this->dateCalc->add_Week($user->start_date);
            }
            $this->Week->start=$new_dates['start'];
            $this->Week->end=$new_dates['end'];
            $this->Week->user_id=$id;
            $this->Week->save();
            return $this->Week;  
        }
        else return false;
    }
    public function get_User_Weeks($coordinator_id, $id){

    }
    public function get_Last_week($id){
        return $this->Week->select('id','start','end')->where('user_id',$id)->orderBy('start', 'DESC')->first();
    }
    public function get_First_week($id){
        return $this->Week->select('id','start','end')->where('user_id',$id)->orderBy('start', 'ASC')->first();
    }
    public function delete_First_week($coordinator_id, $id){

    }
    public function delete_Last_week($coordinator_id, $id){

    }
    public function get_week_by_id($id){
        return $this->Week->with('Days.Statistics')->where('id', $id)->get();
    }
    public function get_user_timetable($coordinator_id, $id){
        if($this->permvalidate->belongs_to_coordinator($coordinator_id, $id)){
            return $this->Week->with('Days.Statistics', 'Days.Times')->where('user_id', $id)->orderBy('start','ASC')->get();
        }
        else return false;
    }
}