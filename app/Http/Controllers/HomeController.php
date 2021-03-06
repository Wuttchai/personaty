<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;
use DB;
use \Cart as Cart;
class HomeController extends Controller

{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('doccumethome');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     public function carsprint($id)
     {

      $date = DB::table('product_Sell')
                  ->select('Prosell_ID','Prosell_creat','Prosell_orderdate','Prosell_img','Prosell_send','Prosell_Quantity','address_name','address_at','address_tumbon','address_aumpor','address_province','address_zipcode','address_tel')
                  ->where('Prosell_ID','=' ,$id)
                  ->get();

      $Car = DB::table('product_Sell')
                  ->join('sell_detail','product_Sell.Prosell_ID','=','sell_detail.Prosell_ID')
                  ->join('product','product.Pro_ID','=','sell_detail.Pro_ID')
                  ->select('product.Pro_Name','sell_detail.Det_Num', 'product.Pro_Price')
                  ->where('sell_detail.Prosell_ID','=' ,$id)
                  ->get();

                return view('carsprint',[
                  'Car' => $Car,
                  'date' => $date,
                ]);
     }
     public function deletecars(Request $request)
     {
       Cart::remove($request->id);


     }
     public function about()
    {
      Session::forget('tabmanu1');
      Session::forget('tabmanu2');
      Session::forget('tabmanu5');
      Session::forget('tabmanu4');
      Session::forget('tabmanu');
      Session::put("tabmanu3","active");
      if ($_GET['type'] == 'ประวัติความเป็นมา') {
return view('about.history');
    }
    if ($_GET['type'] == 'วิสัยทัศน์และพันธกิจ') {
  return view('about.vision');
  }  if ($_GET['type'] == 'โครงสร้างหน่วยงาน') {
    $about = DB::table('person_count')
    ->where('Person_Type','=','โครงสร้างหน่วยงาน')
->orderBy('perupdated_at', 'desc')->limit(1)->get();
    return view('about.organization',[
  'about' => $about
]);

  }  if ($_GET['type'] == 'ทำเนียบผู้บริหาร') {
    $about = DB::table('person_count')
    ->where('Person_Type','=','ทำเนียบผู้บริหาร')
->orderBy('perupdated_at', 'desc')->limit(1)->get();
    return view('about.executives',[
  'about' => $about
]);

  }  if ($_GET['type'] == 'ยุทธศาสตร์') {
return view('about.strategic');
  }
  if ($_GET['type'] == 'ข้อมูลบุคลากร') {
    $about = DB::table('person_count')
    ->where('Person_Type','=','ข้อมูลบุคลากร')
    ->orderBy('perupdated_at', 'desc')->limit(1)->get();
     return view('about.Personnel',[
    'about' => $about
    ]);

  }if ($_GET['type'] == 'ข้อมูลสถิติผู้ต้องขัง') {

    $about = DB::table('person_count')
    ->where('Person_Type','=','ข้อมูลสถิติผู้ต้องขัง')
  ->orderBy('perupdated_at', 'desc')->limit(1)->get();
   return view('about.statistics',[
    'about' => $about
    ]);




return view('about.vision');
  }






    }
     public function showpdf($id)
    {

      $file = \App\doccument::select('doccument.doc_file')
                  ->where('doc_id','=',$id)
                  ->get();

                  return view('official.pdf',[

                    'file' => $file
                  ]);

    }
     public function addcars(Request $request)
     {

  $product = \App\product::select('Pro_ID', 'Pro_Name', 'Pro_Price', 'Pro_Count')
             ->where('Pro_ID','=' , $request->id)
             ->get();


Cart::add([
  ['id' => $request->id, 'name' => $product[0]->Pro_Name, 'qty' => $request->quantity, 'price' => $product[0]->Pro_Price,'options' => ['size' => $product[0]->Pro_Count]]
]);


     }
     public function editcars(Request $request)
     {

Cart::update($request->id, ['qty' => $request->qty]);

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
                   return view('user.detailproduct',[
                   'product' => $product
                   ]);

     }
     public function webbord()
     {
       Session::forget('tabmanu4');
       Session::forget('tabmanu3');
       Session::forget('tabmanu');
         Session::forget('tabmanu1');
       Session::put("tabmanu2","active");




       if (isset($_GET['q'])) {
   $keyword = $_GET['q'];
   $question = \App\question::join('users','question.User_ID','=','users.User_ID')
   ->join('questiondetail','questiondetail.ques_id','=','question.ques_id')
   ->select('question.ques_id',DB::raw('count(questiondetail.quesde_id) as user_count'), 'question.ques_name','question.ques_detail', 'question.ques_date','users.User_ID','users.User_Name', 'question.ques_type','question.ques_id','question.quesde_owner')
   ->GROUPBY('question.ques_id','users.User_ID')
    ->where('ques_name', 'LIKE', "%$keyword%")
   ->orderBy('ques_date', 'desc')->paginate(5);

   return view('user.webboard',[
   'question' => $question
   ]);
       }
 if (isset($_GET['type'])) {
       if ($_GET['type'] == 'การเยี่ยมผู้ต้องขัง') {

         $question = \App\question::join('users','question.User_ID','=','users.User_ID')
         ->join('questiondetail','questiondetail.ques_id','=','question.ques_id')
         ->select('question.ques_id',DB::raw('count(questiondetail.quesde_id) as user_count'), 'question.ques_name','question.ques_detail', 'question.ques_date','users.User_ID','users.User_Name', 'question.ques_type','question.ques_id','question.quesde_owner')
         ->GROUPBY('question.ques_id','users.User_ID')
         ->where('ques_type','=','การเยี่ยมผู้ต้องขัง')
         ->orderBy('ques_date', 'desc')->paginate(5);

         return view('user.webboard',[
         'question' => $question
         ]);

       }
       if ($_GET['type'] == 'การซื้อสินค้า') {
         $question = \App\question::join('users','question.User_ID','=','users.User_ID')
         ->join('questiondetail','questiondetail.ques_id','=','question.ques_id')
         ->select('question.ques_id',DB::raw('count(questiondetail.quesde_id) as user_count'), 'question.ques_name','question.ques_detail', 'question.ques_date','users.User_ID','users.User_Name', 'question.ques_type','question.ques_id','question.quesde_owner')
         ->GROUPBY('question.ques_id','users.User_ID')
         ->where('ques_type','=','การซื้อสินค้า')
         ->orderBy('ques_date', 'desc')->paginate(5);

         return view('user.webboard',[
         'question' => $question
         ]);


       }
       if ($_GET['type'] == 'การเตรียมเอกสาร') {
         $question = \App\question::join('users','question.User_ID','=','users.User_ID')
         ->join('questiondetail','questiondetail.ques_id','=','question.ques_id')
         ->select('question.ques_id',DB::raw('count(questiondetail.quesde_id) as user_count'), 'question.ques_name','question.ques_detail', 'question.ques_date','users.User_ID','users.User_Name', 'question.ques_type','question.ques_id','question.quesde_owner')
         ->GROUPBY('question.ques_id','users.User_ID')
         ->where('ques_type','=','การเตรียมเอกสาร')
         ->orderBy('ques_date', 'desc')->paginate(5);

         return view('user.webboard',[
         'question' => $question
         ]);
       }
     }
       $question = \App\question::join('users','question.User_ID','=','users.User_ID')
       ->join('questiondetail','questiondetail.ques_id','=','question.ques_id')
       ->select('question.ques_id',DB::raw('count(questiondetail.quesde_id) as user_count'), 'question.ques_name','question.ques_detail', 'question.ques_date','users.User_ID','users.User_Name', 'question.ques_type','question.ques_id','question.quesde_owner')
       ->GROUPBY('question.ques_id','users.User_ID')
       ->orderBy('ques_date', 'desc')->paginate(5);


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
      Session::forget('tabmanu3');
      Session::forget('tabmanu4');
      Session::forget('tabmanu');
      Session::put("tabmanu5","active");

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
                  ->where('Info_status','=','checked')
                  ->orderBy('info.Info_up', 'desc')->limit(5)->get();

      $hotnew = \App\hotnews::select('Hotnews_ID', 'hotnews.Hotnews_name','Hotnews_img', 'Hotnews_detail', 'datefirst', 'datelast')
                  ->where('Hotnews_type','=','ข่าวประชาสัมพันธ์')
                  ->where('Hotnews_status','=','checked')
                  ->orderBy('hotnews.hotupdated_at', 'desc ')->limit(3)->get();

                  $time =Carbon::now('Asia/Bangkok');


    $hotnew2 = \App\hotnews::select('Hotnews_ID', 'hotnews.Hotnews_name','Hotnews_img', 'Hotnews_detail', 'datefirst', 'datelast')
          ->where('Hotnews_type','=','ข่าวกิจกรรม')
          ->where('Hotnews_status','=','checked')
          ->orderBy('hotnews.hotupdated_at', 'desc ')->limit(6)->get();

          $doccument = \App\doccument::select('doccument.doc_id','doc_name', 'doc_file')
                  ->where('doc_status','=','checked')
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
