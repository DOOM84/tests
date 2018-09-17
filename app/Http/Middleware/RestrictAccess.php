<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;

class RestrictAccess
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
        if (Auth::check()){
            return $next($request);
        }
        //Session::put('url.intended', URL::current());
        return redirect('/login');
    }
}
