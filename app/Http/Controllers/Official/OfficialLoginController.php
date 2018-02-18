<?php

namespace App\Http\Controllers\Official;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class OfficialLoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

      $Validator=  Validator::make($request->all(), [
          'email' => 'required|email',
          'password' => 'required|string'

            ])->validate();




  $official = \App\official::where([
          ['official_Email' ,'=' ,$request->email],
          ['official_Password' ,'=' ,$request->password]
        ])->get()->toarray();


if ($official == null) {
  return view('official.official', [
      'erx' => 'has',
    ]);
}

if ($official != null) {


$time =Carbon::now('Asia/Bangkok');
if (!Session::get("login")) {

\App\log::insert([
              'official_ID' => $official[0]['official_ID'],
              'table_log' => 'official',
              'project_log' => '0',
              'Log_Event' => 'เข้าสู่ระบบ',
              'Log_IP'  => \Request::ip(),
              'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
            ]);

}

Session::put("login", 'yes');
Session::put("idoffice", $official[0]['official_ID']);
Session::put("nameoffice", $official[0]['official_Name']);
Session::put("role", $official[0]['official_Role']);

  return view('official.officialform');
}






    }
}
