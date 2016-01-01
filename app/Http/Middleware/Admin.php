<?php

namespace App\Http\Middleware;

use Closure,adminAuth;

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
        $data = [
            'username' => $request->input('uname'),
            'password' => $request->input('passwd'),
        ];
        if(adminAuth::attempt($data)){
            return $next($request);
        }else{
            abort(404);
        }
    }
}
