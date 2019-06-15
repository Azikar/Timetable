<?php

namespace App\Http\Controllers;

use App\Interfaces\UserInterface;
use Illuminate\Http\Request;
use App\Validators\UserRepoValidator;
use App\Interfaces\PasswordEncInterface;
use App\Interfaces\SubordinatesInterface;


class UserController extends Controller
{
    public function __construct(UserInterface $user, PasswordEncInterface $auth, SubordinatesInterface $subordinates)
    {
        $this->user=$user;
        $this->validator=new UserRepoValidator();
        $this->auth=$auth;
        $this->subordinates=$subordinates;
    }

    public function add_subordinate(Request $request){
        $this->validate($request, $this->validator->createUserRules);
        //dd($request->all());
        $createdUser= $this->user->create_user($request);
        return response()->json([
            'id'=>$createdUser->id,
            'name'=>$createdUser->name,
            'email'=>$createdUser->email
        ],200);

    }
    public function get_subordinates(Request $request){
        $data=$this->subordinates->UserSubordinates($request->coordinator_id);
        return response()->json(['data'=>$data],200);
    }
}