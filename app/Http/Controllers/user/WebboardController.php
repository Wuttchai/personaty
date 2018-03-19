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
$this->middleware('auth');
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

             $ques_id =  \App\question::where([
                 ['User_ID', '=', Auth::user()->User_ID],
                 ])->max('ques_id');

                 \App\questiondetail::insert([
                   'User_ID' => Auth::user()->User_ID,
                   'ques_id' => $ques_id,
                   'quesde_detail' => '-',
                   'quesde_date'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
             ]);

}
     }

     public function showcomment($id)
     {

       $comment = \App\question::join('users','question.User_ID','=','users.User_ID')
                   ->select('question.ques_id', 'question.ques_name','question.ques_detail', 'question.ques_date', 'question.ques_type','users.User_Name')
                   ->where('question.ques_id','=' ,$id)
                   ->get();

                   $commentdetail = \App\questiondetail::join('users','users.User_ID','=','questiondetail.User_ID')

                               ->select('questiondetail.quesde_id', 'users.User_Name','questiondetail.quesde_detail', 'questiondetail.quesde_date')
                               ->where('questiondetail.ques_id','=' ,$id)
                               ->paginate(5);


return view('user.comment',[
'comment' => $comment,
'commentdetail' => $commentdetail
]);

     }
     public function store(Request $request)
     {

       $validator =  Validator::make($request->all(), [
           'message' => 'required|string',
              ])->validate();

       $time =Carbon::now('Asia/Bangkok');
           \App\questiondetail::insert([
             'User_ID' => Auth::user()->User_ID,
             'ques_id' => $request->id,
             'quesde_detail' => $request->message,
             'quesde_date'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
       ]);



                               return redirect()->route('showcomment', ['id' => $request->id]);



     }

    public function index()
    {
      Session::forget('tabmanu');
        Session::forget('tabmanu1');
      Session::put("tabmanu2","active");


      $question = \App\question::join('users','question.User_ID','=','users.User_ID')
                  ->join('questiondetail','questiondetail.ques_id','=','question.ques_id')
                  ->select('question.ques_id', 'question.ques_name','question.ques_detail', 'question.ques_date', 'question.ques_type','users.User_Name',DB::raw('count(questiondetail.quesde_id) as user_count'))
                  ->GROUPBY('question.ques_id')
                  ->orderBy('ques_date', 'asc')->paginate(5);
                  $question2 = \App\question::select('question.ques_id', 'question.ques_name','question.ques_detail', 'question.ques_date', 'question.ques_type')
                            ->get();

      return view('user.webboard',[
      'question' => $question
      ]);
    }

}
