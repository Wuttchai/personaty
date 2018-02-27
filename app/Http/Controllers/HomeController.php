<?php

namespace App\Http\Controllers;

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
      $info = \App\info::select('Info_ID', 'Info_Name', 'Info_Img')
                  ->orderBy('infoupdated_at', 'desc')->limit(5)->get();

      $hotnew = \App\hotnews::select('Hotnews_ID', 'Hotnews_Name','Hotnews_img', 'Hotnews_detail', 'datefirst', 'datelast')
                  ->orderBy('datelast', 'desc')->limit(3)->get();

        return view('home',[
          'infos' => $info,
          'hotnews' => $hotnew
        ]);
    }
}
