<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authcheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if(!session()->has('LoggedUser') && ($request->path() == 'advisor/dashboard')){
            return redirect('auth/login')->with('fail','You need to login ');
        }
        if(session()->has('LoggedUser') && ($request->path() != 'advisor/dashboard')){
                return redirect('advisor/dashboard');
            }
        return $next($request);
    }
}
