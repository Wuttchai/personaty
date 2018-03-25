<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;
class WebboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {

     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


     public function addqes(Request $request)
     {

$validator =  Validator::make($request->all(), [
    'type' => 'required|string',
    'headqestion' => 'required|string|unique:question,ques_name|max:50|min:10',
    'textqestion' => 'required|string|unique:question,ques_detail|max:200|min:30'

       ]);

       if($validator->fails()){

             return[
             'messages' => $validator->errors()->messages()
             ];
           }else {
$time =Carbon::now('Asia/Bangkok');
if (Session::get('login') == 'yes') {

      \App\question::insert([
        'User_ID' => '1',
        'quesde_owner' => 'เจ้าหน้าที่',
        'ques_name' => $request->headqestion,
        'ques_detail' => $request->textqestion,
        'ques_type' => $request->type,
        'ques_date'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
  ]);
  $ques_id =  \App\question::where([
      ['User_ID', '=', '1'],
      ])->max('ques_id');

      \App\questiondetail::insert([
        'User_ID' => '1',
        'ques_id' => $ques_id,
        'quesde_detail' => $request->textqestion,
        'quesde_owner'=> 'เจ้าหน้าที่',
        'quesde_date'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
  ]);
}else {
                  \App\question::insert([
                    'User_ID' => Auth::user()->User_ID,
                    'quesde_owner' =>'ผู้ใช้',
                    'ques_name' => $request->headqestion,
                    'ques_detail' => $request->textqestion,
                    'ques_type' => $request->type,
                    'ques_date'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
              ]);

              $ques_id =  \App\question::where([
                  ['User_ID', '=', Auth::user()->User_ID],
                  ])->max('ques_id');

                  \App\questiondetail::insert([
                    'User_ID' => Auth::user()->User_ID,
                    'ques_id' => $ques_id,
                    'quesde_detail' => $request->textqestion,
                    'quesde_owner'=> 'ผู้ใช้',
                    'quesde_date'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
              ]);
}




}
     }


     public function store(Request $request)
     {

       $validator =  Validator::make($request->all(), [
           'message' => 'required|string',
              ])->validate();

       $time =Carbon::now('Asia/Bangkok');

       if (Session::get('login') == 'yes') {
         \App\questiondetail::insert([
           'User_ID' => '1',
           'official_ID' => 'เจ้าหน้าที่',
           'ques_id' => $request->id,
           'quesde_detail' => $request->message,
           'quesde_date'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
     ]);

       }else {
         \App\questiondetail::insert([
           'User_ID' => Auth::user()->User_ID,
           'official_ID' => 'ผู้ใช้',
           'ques_id' => $request->id,
           'quesde_detail' => $request->message,
           'quesde_date'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
     ]);
       }


                               return redirect()->route('showcomment', ['id' => $request->id]);



     }
     public function openedit($id)
     {
       $question = \App\question::select('ques_name', 'ques_detail', 'ques_type','ques_id')
                  ->where('ques_id','=' , $id)
                  ->get();

return response()->json($question);

     }

     public function openedit(Request $request,$id)
     {
       $validator =  Validator::make($request->all(), [
           'type' => 'required|string',
           'headqestion' => 'required|string|unique:question,ques_name|max:50|min:10',
           'textqestion' => 'required|string|unique:question,ques_detail|max:200|min:30'

              ]);

              if($validator->fails()){

                    return[
                    'messages' => $validator->errors()->messages()
                    ];
                  }else {
       $time =Carbon::now('Asia/Bangkok');

       \App\question::where('ques_id',$id)
                   ->update([
                     'ques_name' => $request->headqestion,
                     'ques_detail' => $request->textqestion,
                     'ques_type' => $request->type,
                     'ques_date' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                   ]);

return redirect('/webboard');
}


       $question = \App\question::select('ques_name', 'ques_detail', 'ques_type','ques_id')
                  ->where('ques_id','=' , $id)
                  ->get();

return response()->json($question);

     }

}
