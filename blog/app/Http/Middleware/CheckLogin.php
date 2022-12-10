<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Session\Session;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() && $request->session()->has('user') != 0){
            return $next($request);
        }

        return redirect('/Login');
    }
}
