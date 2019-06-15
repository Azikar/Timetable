<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Jwt;
use App\User;
class TokenMiddleware
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
        $token=$request->header('Authorization');
        
        if($jwt->validateJwt($token)){
            $payload=$jwt->getPayload($token);
            if($user->findOrFail($payload))
            $request->merge([
                'coordinator_id' => $payload
            ]);
            return $next($request);
        }
    }
}
