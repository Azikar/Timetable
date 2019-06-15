<?php

namespace App\Http\Controllers;

use App\Interfaces\UserInterface;
use Illuminate\Http\Request;
use App\Validators\UserRepoValidator;

class RegistrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $user;

    public function __construct(UserInterface $user)
    {
        $this->user=$user;
        $this->validator=new UserRepoValidator();
    }

    public function Registrate(Request $request){
        $this->validate($request, $this->validator->createCoordinatorRules);
        $this->user->create_coordinator($request);
        
        return 'saved';
    }

    //
}