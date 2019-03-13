<?php

namespace App\Http\Middleware;

use Closure;


class FileUploaded
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
        if(!session()->has('file')) {
            return redirect('/working_area');
        }
        return $next($request);
    }
}
