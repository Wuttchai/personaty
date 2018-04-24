<?php

namespace App\Http\Controllers\Official;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Intervention\Image\ImageManager ;
use DB;

class ProductsellControll extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
         $this->middleware('ckloginoffice');
     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

public $timestamps = false;

     public function readItems() {
       $xxx = \App\product_sell::join('users','product_Sell.User_ID','=','users.User_ID')
                   ->select('users.User_Name', 'product_Sell.Prosell_Quantity', 'product_Sell.Prosell_totalPirce','product_Sell.Prosell_orderdate','product_Sell.Prosell_ID','product_Sell.Prosell_send')
                   ->where('Prosell_orderdate','!=','')
                    ->orderBy('Prosell_creat', 'desc')
                   ->get();



     		return response()->json($xxx);
     	}

 public function showdetail($id)
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

            return view('official.detailproduct',[
              'Car' => $Car,
              'date' => $date,
            ]);
}



     public function insert(Request $request)
     {

if ($request->status == 'delete') {
  $time =Carbon::now('Asia/Bangkok');
      \App\log::insert([
        'official_ID' => Session::get('idoffice'),
        'table_log' => 'ข้อมูลการสั่งซื้อสินค้า่',
        'project_log' => $request->id,
        'Log_Event' => 'ไม่อนุมัติการสั่งซื้อ',
        'Log_IP'  => \Request::ip(),
        'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
  ]);


                      \App\product_sell::where('Prosell_ID',$request->id)
                                  ->update([
                                    'Prosell_send' => $request->quantity,
                                  ]);
return response()->json($time);
                 }



    $validator =  Validator::make($request->all(), [
         'id' => 'required|alpha_num',
         'quantity' => 'required|numeric',
           ]);

           if($validator->fails()){

                 return[
                 'messages' => $validator->errors()->messages()
                 ];
               }

               else {
                 $string = strip_tags($request->quantity);

                 if (strlen($string) < 13) {
                 $info = ['',''];
                 $info[0] ='true';
                 $info[1] ='หมายเลขพัสดุต้องเท่ากับ 13 หลัก';
                   return response()->json($info);

                 }elseif (strlen($string) > 14) {
                   $info = ['',''];
                   $info[0] ='true';
                   $info[1] ='หมายเลขพัสดุต้องเท่ากับ 13 หลัก';
                   return response()->json($info);
                 }


$time =Carbon::now('Asia/Bangkok');
    \App\log::insert([
      'official_ID' => Session::get('idoffice'),
      'table_log' => 'ข้อมูลการสั่งซื้อสินค้า่',
      'project_log' => $request->id,
      'Log_Event' => 'เพิ่มหมายเลขพัสดุ',
      'Log_IP'  => \Request::ip(),
      'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
]);


                    \App\product_sell::where('Prosell_ID',$request->id)
                                ->update([
                                  'Prosell_send' => $request->quantity,
                                ]);

               }





     }






    public function index()
    {

      return view('official.productsell');

    }



}
