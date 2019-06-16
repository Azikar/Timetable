<?php

namespace App\Http\Controllers;

use App\Interfaces\UserInterface;
use Illuminate\Http\Request;
use App\Validators\UserRepoValidator;
use App\Interfaces\PasswordEncInterface;
use App\Interfaces\SubordinatesInterface;
use App\Interfaces\PermissionsValidatorInterface;

class UserController extends Controller
{
    public function __construct(UserInterface $user, PasswordEncInterface $auth, SubordinatesInterface $subordinates, PermissionsValidatorInterface $permvalidate)
    {
        $this->user=$user;
        $this->validator=new UserRepoValidator();
        $this->auth=$auth;
        $this->subordinates=$subordinates;
        $this->permvalidate=$permvalidate;
    }

    public function add_subordinate(Request $request){
        $this->validate($request, $this->validator->createUserRules);
        $createdUser= $this->user->create_user($request);
        return response()->json([
            'id'=>$createdUser->id,
            'name'=>$createdUser->name,
            'email'=>$createdUser->email
        ],200);

    }
    public function get_subordinates(Request $request){
        $user=$this->user->get_User_By_id($request->coordinator_id);
        $data=$this->subordinates->UserSubordinates($user);
        return response()->json(['data'=>$data],200);
    }
    public function delete_subordinate(Request $request, $id){
        if($this->permvalidate->belongs_to_coordinator($request->coordinator_id, $id)){
            $this->user->delete_user($id);
            return response()->json([
                'message'=>'deleted',
            ],200);
        }
        else return response()->json([
            'message'=>'failed',
        ],400);
    }

    public function set_timetable_start_date(Request $request, $id)
    {

        $this->validate($request, $this->validator->timetableStartRule);
        if($this->permvalidate->belongs_to_coordinator($request->coordinator_id, $id)){
            $this->user->set_timetable_start_date($id, $request->start_date);
            return response()->json([
                'message'=>'Date changed',
            ],200);
        }
        else return response()->json([
            'message'=>'faile',
        ],400);
    }
    
}