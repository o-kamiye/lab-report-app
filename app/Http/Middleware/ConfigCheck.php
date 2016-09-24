<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class ConfigCheck
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
        $users = User::all();
        if ($users->count()) {
            return redirect('/');
        }
        return $next($request);
    }
}
