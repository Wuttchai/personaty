<?php

namespace App\Http\Controllers\Official;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Auth;

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
     public function logout(Request $request)
     {



       Session::forget('login');
       Session::forget('idoffice');
       Session::forget('nameoffice');
       Session::forget('info');
       Session::forget('product');
       Session::forget('hotnews');
       Session::forget('activity');
       Session::forget('prison');


       $request->session()->regenerate();
       $request->session()->forget('login');




       $request->session()->invalidate();

       return redirect('/officialapp');





     }
    public function login(Request $request)
    {

      $Validator=  Validator::make($request->all(), [
          'email' => 'required|email',
          'password' => 'required|regex:/^([a-zA-Z0-9ก-ูเ-๋๑-๙])/'

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


Session::put("info",$official[0]['info']);
Session::put("product",$official[0]['product']);
Session::put("hotnews",$official[0]['hotnews']);
Session::put("activity",$official[0]['activity']);
Session::put("prison",$official[0]['prison']);
Session::put("document",$official[0]['document']);
Session::put("calender",$official[0]['calender']);
Session::put("login", 'yes');
Session::put("idoffice", $official[0]['official_ID']);
Session::put("nameoffice", $official[0]['official_Name']);
Session::put("role", $official[0]['official_Role']);



if ($official[0]['info'] == 'จัดการ') {
  return redirect('/official/add');
}
if ($official[0]['product'] == 'จัดการ') {
  return redirect('/official/product');

}
if ($official[0]['hotnews'] == 'จัดการ') {
return redirect('/official/hotnews');
}
if ($official[0]['activity'] == 'จัดการ') {
return redirect('/official/addoffice');
}
if ($official[0]['prison'] == 'จัดการ') {

return redirect('/official/person');
}
if ($official[0]['document'] == 'จัดการ') {

return redirect('/official/document');
}
if ($official[0]['calender'] == 'จัดการ') {

return redirect('/official/calender');
}
}






    }
}
