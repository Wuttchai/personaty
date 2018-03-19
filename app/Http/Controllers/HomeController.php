<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      Session::forget('tabmanu1');
      Session::forget('tabmanu2');
      Session::put("tabmanu","active");
      $info = \App\info::select('Info_ID', 'Info_Name', 'Info_Img')
                  ->orderBy('info.infoupdated_at', 'desc')->limit(5)->get();

      $hotnew = \App\hotnews::select('Hotnews_ID', 'hotnews.Hotnews_name','Hotnews_img', 'Hotnews_detail', 'datefirst', 'datelast')
                  ->where('Hotnews_type','=','ข่าวประชาสัมพันธ์')
                  ->orderBy('datelast', 'desc')->limit(3)->get();

                  $time =Carbon::now('Asia/Bangkok');


    $hotnew2 = \App\hotnews::select('Hotnews_ID', 'hotnews.Hotnews_name','Hotnews_img', 'Hotnews_detail', 'datefirst', 'datelast')
          ->where('Hotnews_type','=','ข่าวกิจกรรม')
          ->orderBy('datelast', 'desc')->limit(3)->get();


          $time =Carbon::now('Asia/Bangkok');
  Session::put("date","" . $time->day. "/" . $time->month . "/" . $time->year . "");
        return view('home',[
          'infos' => $info,
          'hotnews' => $hotnew,
          'hotnews2' => $hotnew2
        ]);
    }
}
