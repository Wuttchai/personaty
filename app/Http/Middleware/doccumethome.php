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
            ->orderBy('doccument.doc_dateup', 'desc ')->limit(8)->get();
            $question2 = \App\question::select('question.ques_id', 'question.ques_name','question.ques_detail', 'question.ques_date', 'question.ques_type')
                      ->limit(7)->get();
            Session::put("doccumenthome",$doccumenthome);
            Session::put("question",$question2);

        return $next($request);
    }
}
