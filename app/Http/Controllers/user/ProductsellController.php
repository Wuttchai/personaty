<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use \Cart as Cart;
use Illuminate\Support\Facades\Auth;
use DB;
class ProductsellController extends Controller
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
public $qtv = 0 ;




     public function ProductCarOrders()
     {

       Session::forget('tabmanu1');
       Session::forget('tabmanu2');
       Session::forget('tabmanu3');
       Session::forget('tabmanu');
       Session::put("tabmanu4","active");

       $CarOrders = \App\product_sell::select('Prosell_ID', 'Prosell_Quantity','Prosell_totalPirce', 'Prosell_creat','Prosell_send')
                   ->where('User_ID','=' ,Auth::user()->User_ID)
                   ->orderBy('product_Sell.Prosell_creat', 'desc')->paginate(10);

                   return view('user.detailuser',[
                     'CarOrders' => $CarOrders
                   ]);
     }
     public function ProductCardetail($id)
     {

       $date = DB::table('product_Sell')
                   ->select('Prosell_ID','Prosell_creat','Prosell_orderdate','Prosell_creat','Prosell_img','Prosell_send','Prosell_Quantity')
                   ->where('Prosell_ID','=' ,$id)
                   ->get();

       $Car = DB::table('product_Sell')
                   ->join('sell_detail','product_Sell.Prosell_ID','=','sell_detail.Prosell_ID')
                   ->join('product','product.Pro_ID','=','sell_detail.Pro_ID')
                   ->select('product.Pro_Name','sell_detail.Det_Num', 'product.Pro_Price')
                   ->where('sell_detail.Prosell_ID','=' ,$id)
                   ->get();




return view('user.detailcars',[
  'Car' => $Car,
  'date' => $date,
]);
}
public function ProductCarorderdetail($id)
{
  $Prosell_ID =  \App\product_sell::where([
      ['User_ID', '=', Auth::user()->User_ID],
      ])->max('Prosell_ID');

              $date = DB::table('product_Sell')
              ->select('Prosell_name','Prosell_address')
              ->where('Prosell_ID','=' ,$Prosell_ID)
              ->get();
  $Car = DB::table('product_Sell')
              ->join('sell_detail','product_Sell.Prosell_ID','=','sell_detail.Prosell_ID')
              ->join('product','product.Pro_ID','=','sell_detail.Pro_ID')
              ->select('product.Pro_Name','sell_detail.Det_Num', 'product.Pro_Price')
              ->where('sell_detail.Prosell_ID','=' ,$id)
              ->get();




return view('user.insrtimgcar',[
'Car' => $Car,
'date' => $date,
]);
}
public function ProductCarorderdelete($id)
{


\App\product_sell::where('Prosell_ID', '=', $id)->delete();

return redirect('/ProductCarOrders');

}
public function editsend(Request $request,$id)
{
  Validator::make($request->all(), [
        'name' => 'required|regex:/^([a-zA-Zก-ูเ-๋])/|max:255',
        'address' => 'required|string',

    ])->validate();

                \App\product_sell::where('Prosell_ID',$id)
                            ->update([
                              'Prosell_name' => $request->name,
                              'Prosell_address' => $request->address,
                              ]);
return redirect()->route('showcar');


}
public function index()
{
  $Prosell_ID =  \App\product_sell::where([
      ['User_ID', '=', Auth::user()->User_ID],
      ])->max('Prosell_ID');
  $date = DB::table('product_Sell')
  ->select('Prosell_name','Prosell_address')
  ->where('Prosell_ID','=' ,$Prosell_ID)
  ->get();

  return view('user.showcars',[
  'date'=>$date,
  'Prosell_ID' => $Prosell_ID
  ]);

}
}
