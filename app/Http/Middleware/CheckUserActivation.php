<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckUserActivation
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
        if(!Auth::user()->active) {
            return redirect('/user/activation');
        }
        return $next($request);
    }
}
