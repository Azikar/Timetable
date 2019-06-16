<?php

namespace App\Services;

use App\Interfaces\weekFillServiceInterface;
use App\Interfaces\dateCalculatorInterface;


class weekFillService implements weekFillServiceInterface{

    public function __construct(dateCalculatorInterface $dateCalc){
        $this->dateCalc=$dateCalc;
    }
    public function fill_week_with_7_days($week){
        $index=0;
        $days=[];
        $dayDate=$week->start;
        $day=['date'=>$dayDate,
        'user_id'=>$week->user_id,
        'week_id'=>$week->id];
        while($index<7){
            $days[]=$day;
            $day['date']= $this->dateCalc->add_day($day['date']);
            $index++;
        }
        return $days;
    }
}