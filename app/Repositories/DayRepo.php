<?php

namespace App\Repositories;


use App\Interfaces\DayRepoInterface;
use App\Day;
use App\weekFillServiceInterface;


class DayRepo implements DayRepoInterface{

    public function __construct(){
       $this->day=new Day(); 
    }

    public function create_days($days){
        // dd($days);
        return $this->day->insert($days);
    }
}