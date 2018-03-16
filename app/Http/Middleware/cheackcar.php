<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use \Cart as Cart;
class cheackcar
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

        if (Cart::content() == "[]") {
          return redirect('/ProductAyutaya');
        }
        return $next($request);
    }
}
