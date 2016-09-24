<?php

namespace App\Http\Middleware;

use Closure;

class OperatorCheck
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
        if ($request->session()->has('operator')) {
            return $next($request);
        }
        else if ($request->session()->has('patient')) {
            return redirect('/report/list');
        }
        return redirect('/login');
    }
}
