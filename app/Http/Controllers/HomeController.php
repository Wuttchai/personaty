<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;
use DB;
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
     public function deletecars(Request $request)
     {
       Cart::remove($request->id);


     }
     
     public function addcars(Request $request)
     {
  $product = \App\product::select('Pro_ID', 'Pro_Name', 'Pro_Price')
             ->where('Pro_ID','=' , $request->id)
             ->get();



$cartItem = Cart::add($request->id, $product[0]->Pro_Name, $request->quantity, $product[0]->Pro_Price);



     }
     public function detailhotnew($id)
     {
       $hotnew2 = \App\hotnews::select('Hotnews_ID', 'hotnews.Hotnews_name','Hotnews_img', 'Hotnews_detail', 'datefirst', 'datelast')
             ->where('Hotnews_ID','=',$id)
             ->get();

    return view('user.showhotnews',[
      'hotnew' => $hotnew2
    ]);
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
     public function productview($id)
     {
       $product = \App\product::select('Pro_ID', 'Pro_Name','Pro_img', 'Pro_Price', 'Pro_Type','Pro_Count','Pro_Detail')
                   ->where('Pro_ID', '=', $id)
                   ->get();

       return response()->json($product);
     }
     public function webbord()
     {
       Session::forget('tabmanu4');
       Session::forget('tabmanu3');
       Session::forget('tabmanu');
         Session::forget('tabmanu1');
       Session::put("tabmanu2","active");


$question = \App\question::join('users','question.User_ID','=','users.User_ID')
->join('questiondetail','questiondetail.ques_id','=','question.ques_id')
->select('question.ques_id',DB::raw('count(questiondetail.quesde_id) as user_count'), 'question.ques_name','question.ques_detail', 'question.ques_date','users.User_Name', 'question.ques_type')
->GROUPBY('question.ques_id','users.User_Name')
->orderBy('ques_date', 'desc')->paginate(5);



                   $question2 = \App\question::select('question.ques_id', 'question.ques_name','question.ques_detail', 'question.ques_date', 'question.ques_type')
                             ->get();

       return view('user.webboard',[
       'question' => $question
       ]);
     }

     public function Product()
     {
   if (isset($_GET['price'])) {
   if ($_GET['price'] == 'one') {
   $product = \App\product::select('Pro_ID', 'Pro_Name','Pro_img', 'Pro_Price', 'Pro_Type','Pro_Count','Pro_Detail')
               ->where('Pro_Price', '<', 1000)
               ->paginate(6);
               return view('user.product',[
                 'products' => $product
               ]);
   }
   if ($_GET['price'] == 'two') {
   $product = \App\product::select('Pro_ID', 'Pro_Name','Pro_img', 'Pro_Price', 'Pro_Type','Pro_Count','Pro_Detail')
               ->where('Pro_Price', '>=', 1000)
               ->paginate(6);
               return view('user.product',[
                 'products' => $product
               ]);
   }
   if ($_GET['price'] == 'ASC') {
   $product = \App\product::select('Pro_ID', 'Pro_Name','Pro_img', 'Pro_Price', 'Pro_Type','Pro_Count','Pro_Detail')
               ->orderBy('Pro_Price', 'asc')
               ->paginate(6);
               return view('user.product',[
                 'products' => $product
               ]);
   }
   if ($_GET['price'] == 'DESC') {
   $product = \App\product::select('Pro_ID', 'Pro_Name','Pro_img', 'Pro_Price', 'Pro_Type','Pro_Count','Pro_Detail')
               ->orderBy('Pro_Price', 'desc')
               ->paginate(6);
               return view('user.product',[
                 'products' => $product
               ]);
   }



   }
       if (isset($_GET['type'])) {
         $product = \App\product::select('Pro_ID', 'Pro_Name','Pro_img', 'Pro_Price', 'Pro_Type','Pro_Count','Pro_Detail')
                     ->orderBy('proupdated_at', 'desc')
                     ->where('Pro_Type', '=', $_GET['type'])
                     ->paginate(6);



         return view('user.product',[
           'products' => $product
         ]);
       }

       if (isset($_GET['q'])) {
   $keyword = $_GET['q'];
         $product = \App\product::select('Pro_ID', 'Pro_Name','Pro_img', 'Pro_Price', 'Pro_Type','Pro_Count','Pro_Detail')
                     ->orderBy('proupdated_at', 'desc')
                     ->where('Pro_Name', 'LIKE', "%$keyword%")
                     ->paginate(6);

           Session::put("search",$_GET['q']);

         return view('user.product',[
           'products' => $product
         ]);
       }
       $time =Carbon::now('Asia/Bangkok');
       Session::forget('tabmanu4');
       Session::forget('tabmanu2');
       Session::forget('tabmanu3');
       Session::forget('tabmanu');

       Session::put("tabmanu1","active");
       Session::put("search","ค้นหา");
       $product = \App\product::select('Pro_ID', 'Pro_Name','Pro_img', 'Pro_Price', 'Pro_Type','Pro_Count','Pro_Detail')
                   ->orderBy('proupdated_at', 'desc')->paginate(6);


       return view('user.product',[
         'products' => $product
       ]);

   }
     public function  documentsh()
     {


       Session::forget('tabmanu1');
       Session::forget('tabmanu2');
       Session::forget('tabmanu3');
       Session::forget('tabmanu');
       Session::put("tabmanu4","active");

       if (isset($_GET['q'])) {
         $keyword = $_GET['q'];
         $doccument = \App\doccument::select('doccument.doc_id','doc_name', 'doc_file')
              ->where('doc_name','LIKE',"%$keyword%")
               ->orderBy('doc_dateup', 'desc')->paginate(5);
           return view('user.documentsh',[
             'doccument' => $doccument

           ]);
       }
       $doccument = \App\doccument::select('doccument.doc_id','doc_name', 'doc_file')
             ->orderBy('doc_dateup', 'desc')->paginate(5);

         return view('user.documentsh',[
           'doccument' => $doccument

         ]);
     }
    public function advertise()
    {
      Session::forget('tabmanu1');
      Session::forget('tabmanu2');
      Session::forget('tabmanu4');
      Session::forget('tabmanu');
      Session::put("tabmanu3","active");

      $hotnew = \App\hotnews::select('Hotnews_ID', 'hotnews.Hotnews_name','Hotnews_img', 'Hotnews_detail', 'datefirst', 'datelast')
                  ->where('Hotnews_type','=','ข่าวประชาสัมพันธ์')
                  ->orderBy('hotnews.hotupdated_at', 'desc ')->paginate(5);

                  $time =Carbon::now('Asia/Bangkok');

  Session::put("date","" . $time->day. "/" . $time->month . "/" . $time->year . "");
        return view('user.advertise',[
          'hotnews' => $hotnew,

        ]);
    }
    public function activities()
    {
      Session::forget('tabmanu1');
      Session::forget('tabmanu2');
      Session::forget('tabmanu');
      Session::put("tabmanu3","active");

      $hotnew = \App\hotnews::select('Hotnews_ID', 'hotnews.Hotnews_name','Hotnews_img', 'Hotnews_detail', 'datefirst', 'datelast')
                  ->where('Hotnews_type','=','ข่าวกิจกรรม')
                  ->orderBy('hotnews.hotupdated_at', 'desc ')->paginate(5);

                  $time =Carbon::now('Asia/Bangkok');

  Session::put("date","" . $time->day. "/" . $time->month . "/" . $time->year . "");
        return view('user.activities',[
          'hotnews' => $hotnew,

        ]);
    }
    public function index()
    {
      Session::forget('tabmanu4');
      Session::forget('tabmanu3');


      Session::forget('tabmanu1');
      Session::forget('tabmanu2');
      Session::put("tabmanu","active");
      $info = \App\info::select('Info_ID', 'Info_Name', 'Info_Img')
                  ->orderBy('info.Info_up', 'desc')->limit(5)->get();

      $hotnew = \App\hotnews::select('Hotnews_ID', 'hotnews.Hotnews_name','Hotnews_img', 'Hotnews_detail', 'datefirst', 'datelast')
                  ->where('Hotnews_type','=','ข่าวประชาสัมพันธ์')
                  ->orderBy('hotnews.hotupdated_at', 'desc ')->limit(3)->get();

                  $time =Carbon::now('Asia/Bangkok');


    $hotnew2 = \App\hotnews::select('Hotnews_ID', 'hotnews.Hotnews_name','Hotnews_img', 'Hotnews_detail', 'datefirst', 'datelast')
          ->where('Hotnews_type','=','ข่าวกิจกรรม')
          ->orderBy('hotnews.hotupdated_at', 'desc ')->limit(6)->get();

          $doccument = \App\doccument::select('doccument.doc_id','doc_name', 'doc_file')
                ->orderBy('doccument.doc_dateup', 'desc ')->limit(5)->get();

                $tasks  = \App\calender::select('cal_date','cal_last','cal_name','cal_id')
                            ->get();


  Session::put("date","" . $time->day. "/" . $time->month . "/" . $time->year . "");
        return view('home',compact('tasks'),[
          'infos' => $info,
          'hotnews' => $hotnew,
          'hotnews2' => $hotnew2,
          'doccument' => $doccument
        ]);
    }
}
