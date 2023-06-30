<?php

namespace App\Http\Middleware;

use Closure;

class StatusCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$status)
    {
        if(auth()->user()->status !== $status){
            return redirect()->route('user.account');
        }
        return $next($request);
    }
}
