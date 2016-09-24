<?php

namespace App\Http\Middleware;

use Closure;

class LoginCheck
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
        if ($request->session()->has('patient')) {
            return $next($request);
        }
        else if ($request->session()->has('operator')) {
            return redirect('/dashboard');
        }
        return redirect('/login');
    }
}
