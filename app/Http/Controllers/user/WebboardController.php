<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
                 \App\question::insert([
                   'User_ID' => Auth::user()->User_ID,
                   'ques_name' => $request->headqestion,
                   'ques_detail' => $request->textqestion,
                   'ques_type' => $request->type,
                   'ques_date'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
             ]);

}
     }

     public function deletecars(Request $request)
     {



     }

    public function index()
    {
      Session::forget('tabmanu');
        Session::forget('tabmanu1');
      Session::put("tabmanu2","active");


      $question = \App\question::join('users','question.User_ID','=','users.User_ID')
                  ->select('question.ques_id', 'question.ques_name','question.ques_detail', 'question.ques_date', 'question.ques_type','users.User_Name')
                  ->orderBy('ques_date', 'asc')->paginate(8);



      return view('user.webboard',[
      'question' => $question
      ]);
    }

}
