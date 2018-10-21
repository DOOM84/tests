<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;

class CheckCookie
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
        //dd($request->cookie('setloc'));
        if ($request->cookie('setloc') == 'ua' || $request->cookie('setloc') == 'en'){
            App::setLocale($request->cookie('setloc'));
        }
        //Session::put('url.intended', URL::current());
        return $next($request);
    }
}
