<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;

class ClientMiddleware
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

        if(!session()->has('LoggedUser') && !session()->has('ClientLoggedUser') && ($request->path() != 'auth/login' && $request->path() != 'auth/register' )){
            return redirect('auth/login')->with('fail','You need to login ');
        }
        if(session()->has('ClientLoggedUser') && !session()->has('LoggedUser') ($request->path() == 'auth/login' || $request->path() == 'auth/register' )){
                return redirect('Client/dashboard');
            }

            if(session()->has('LoggedUser')){
                
            }

        $response = $next($request);

        return $response->header('Cache-Control', 'no-store');

        // return $response->header('Cache-Control', 'nocache, no-store, max-age=0, must-revalidate')
        //                       ->header('Pragma','no-cache')
        //                       ->header('Expires','Sat 01 Jan 1990 00:00:00 GMT');

        
    }
}
