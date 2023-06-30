<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{

    public function handle($request, Closure $next, ...$guards)
    {
        if ($request->route()->getName() == 'guest.home' && auth()->check()) {
            return redirect('/home');
        }
        elseif ($request->route()->getName() == 'guest.home' && !auth()->check()) {
            return $next($request);

        }
        else {
            $this->authenticate($request, $guards);

            return $next($request);
        }

    }
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {



        if (! $request->expectsJson()) {
            return route('guest.home');
        }
    }
}
