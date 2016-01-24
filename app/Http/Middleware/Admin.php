<?php

namespace App\Http\Middleware;

use Closure,Auth,Request,adminAuth,Session;

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
        if($request->session()->has('adminId')){
            return $next($request);
        }else{
            return redirect()->route('admin::view');
        }
    }
}
