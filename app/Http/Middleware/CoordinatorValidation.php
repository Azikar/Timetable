<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Jwt;
use App\User;

class CoordinatorValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
 
    public function handle($request, Closure $next)
    {
        $jwt=new Jwt();
        $user=new User();
        $found=false;
        $token=$request->header('Authorization');
        $payload=$jwt->getPayload($token);
            if($user=$user->findOrFail($payload)){
                $roles=$user->Roles()->get();
                foreach($roles as $role){
                    if($role->title==="_coordinator_"){
                        $found=true;
                        break;
                    }
                }
            }
            $request->merge([
            'coordinator_id' => $payload
            ]);
            if($found)
                return $next($request);
            else return response()->json([
                'message'=>'wrong role',
            ],400);
        }
    
}
