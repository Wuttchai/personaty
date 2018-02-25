<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Ckloginoffice
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
        if (!Session::get('login')) {
          return redirect('/official/login');
        }
        return $next($request);
    }
}
