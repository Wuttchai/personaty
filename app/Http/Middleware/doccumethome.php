<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class doccumethome
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
      $doccumenthome = \App\doccument::select('doccument.doc_id','doc_name', 'doc_file')
            ->orderBy('doccument.doc_dateup', 'desc ')->limit(7)->get();
            Session::put("doccumenthome",$doccumenthome);

        return $next($request);
    }
}
