<?php

namespace App\Http\Controllers;

use App\Interfaces\UserInterface;
use App\Interfaces\JwtInterface;
use Illuminate\Http\Request;
use App\Validators\UserRepoValidator;
use App\Interfaces\PasswordEncInterface;


class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $user;
    protected $jwt;
    protected $auth;
    
    public function __construct(UserInterface $user, JwtInterface $jwt, PasswordEncInterface $auth)
    {
        $this->user=$user;
        $this->validator=new UserRepoValidator();
        $this->jwt=$jwt;
        $this->auth=$auth;
    }

    public function Login(Request $request){
        $this->validate($request, $this->validator->loginRules);
        $user=$this->user->get_user_by_email($request->email);
        if($user && $this->auth->verify($request->password, $user->password))
            {
                $token=$this->jwt->createJwt($user);
                return response()->json([
                    'name' => $user->name,
                    'email'=> $user->email,
                    'jwt' => $this->jwt->createJwt($user),
                    'roles'=>$this->user->get_user_roles($user),
                    'code'=>200,
                ],200);
        }
        else  return response()->json([
            'message'=>'failed to log in',
            'code'=>401,
        ],401);
            
    }
}