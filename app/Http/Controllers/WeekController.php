<?php

namespace App\Http\Controllers;

use App\Interfaces\WeekRepoInterface;
use Illuminate\Http\Request;
use App\Interfaces\weekFillServiceInterface;
use App\Interfaces\DayRepoInterface;

class WeekController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(WeekRepoInterface $week, weekFillServiceInterface $weekFill, DayRepoInterface $dayRepo)
    {
        $this->week=$week;
        $this->weekFill=$weekFill;
        $this->dayRepo=$dayRepo;
    }
    public function add_week_to_end(Request $request, $id){
        $week= $this->week->create_Week_at_end($request->coordinator_id, $id);
        if($week){
            $days= $this->weekFill->fill_week_with_7_days($week);
            $this->dayRepo->create_days($days);
            return response()->json([
                'week'=>$this->week->get_week_by_id($week->id),
            ],200);
        }
        else return response()->json([
            'message'=>'failed',
        ],400);
        
    }
    public function get_user_timetable(Request $request, $id){
        $result=$this->week->get_user_timetable($request->coordinator_id, $id);
        if($result!=false)
            return response()->json([
                'week'=>$result,
            ],200);
        else return response()->json([
            'message'=>'failed',
        ],400);
    }

    public function add_week_to_start(Request $request, $id){
        $week= $this->week->create_Week_at_start($request->coordinator_id, $id);
        if($week){
            $days= $this->weekFill->fill_week_with_7_days($week);
            $this->dayRepo->create_days($days);
            return response()->json([
                'week'=>$this->week->get_week_by_id($week->id),
            ],200);
        }
        else return response()->json([
            'message'=>'failed',
        ],400); 
    }
    public function delete_week_from_start(Request $request, $id){
        if($this->week->delete_First_week($request->coordinator_id, $id))
            return response()->json(['message'=>'success'],200);
        else return response()->json([
                'message'=>'failed',
            ],400);
    }
    public function delete_week_from_end(Request $request, $id){
        if($this->week->delete_Last_week($request->coordinator_id, $id))
            return response()->json(['message'=>'success'],200);
        else return response()->json([
                'message'=>'failed',
            ],400);
    }
}