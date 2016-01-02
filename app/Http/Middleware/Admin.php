<?php

namespace App\Http\Middleware;

use Closure,adminAuth,Request;

class Admin
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
        $data = Request::only('username','password')
        if(adminAuth::attempt($data)){
            return $next($request);
        }else{
            abort(404);
        }
    }
}
