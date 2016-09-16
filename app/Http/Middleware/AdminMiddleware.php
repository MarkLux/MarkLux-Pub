<?php

namespace App\Http\Middleware;

use Closure;
use Gate;

class AdminMiddleware
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
        if(Gate::allows('manage-posts'))
            return $next($request);
        else
            return view('errors.503');
    }
}
