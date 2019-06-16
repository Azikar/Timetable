<?php

namespace App\Services;

use App\Interfaces\dateCalculatorInterface;
use Carbon\Carbon;

class dateCalculator implements dateCalculatorInterface{

    public function __construct(){

    }
    public function add_Week($date){
        $date=new Carbon($date);
        $response['start']=$date->copy()->startOfWeek()->addDays(7);
        $response['end']=$date->copy()->endOfWeek()->addDays(7);
        return $response;
    }
    public function sub_Week($date){
        $date=new Carbon($date);
        $response['start']=$date->copy()->startOfWeek()->subDays(7);
        $response['end']=$date->copy()->endOfWeek()->subDays(7);
        return $response;
    }
    public function add_Day($date){
        $date=new Carbon($date);
        return $date->addDay();
    }
}