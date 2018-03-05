<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use \Cart as Cart;
use Illuminate\Support\Facades\Auth;

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

     public function addcars(Request $request)
     {

  $product = \App\product::select('Pro_ID', 'Pro_Name', 'Pro_Price')
             ->where('Pro_ID','=' , $request->id)
             ->get();



$cartItem = Cart::add($request->id, $product[0]->Pro_Name, $request->quantity, $product[0]->Pro_Price);



     }
     public function confrim(Request $request)
     {

$num =0;
$Quantity = 0;
$totalPirce =0;
     foreach(Cart::content() as $carcon) {

       \App\sell_detail::insert([
                     'Pro_ID' => $carcon->id,
                     'Det_Num'  => $carcon->qty,
                     'Det_total' => $carcon->qty * $carcon->price
                     ]);
       $num ++;
       $Quantity += $carcon->qty;
       $totalPirce += $carcon->qty * $carcon->price;
}
$time =Carbon::now('Asia/Bangkok');

\App\product_sell::insert([
              'User_Name' => Auth::user()->User_ID,
              'Prosell_Quantity' => $Quantity,
              'Prosell_totalPirce'  => $totalPirce,
              'Prosell_send' => '',
              'Prosell_creat'=>   "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
              ]);




     }
     public function deletecars(Request $request)
     {
       Cart::remove($request->id);


     }

    public function index()
    {
if (isset($_GET['price'])) {
if ($_GET['price'] == 'one') {
  $product = \App\product::select('Pro_ID', 'Pro_Name','Pro_img', 'Pro_Price', 'Pro_Type','Pro_Count')
              ->where('Pro_Price', '<', 1000)
              ->limit(4)
              ->get();
              return view('user.product',[
                'products' => $product
              ]);
}
if ($_GET['price'] == 'two') {
  $product = \App\product::select('Pro_ID', 'Pro_Name','Pro_img', 'Pro_Price', 'Pro_Type','Pro_Count')
              ->where('Pro_Price', '>=', 1000)
              ->limit(4)
              ->get();
              return view('user.product',[
                'products' => $product
              ]);
}
if ($_GET['price'] == 'ASC') {
  $product = \App\product::select('Pro_ID', 'Pro_Name','Pro_img', 'Pro_Price', 'Pro_Type','Pro_Count')
              ->orderBy('Pro_Price', 'asc')

              ->limit(4)
              ->get();
              return view('user.product',[
                'products' => $product
              ]);
}
if ($_GET['price'] == 'DESC') {
  $product = \App\product::select('Pro_ID', 'Pro_Name','Pro_img', 'Pro_Price', 'Pro_Type','Pro_Count')
              ->orderBy('Pro_Price', 'desc')
              ->limit(4)
              ->get();
              return view('user.product',[
                'products' => $product
              ]);
}



}
      if (isset($_GET['type'])) {
        $product = \App\product::select('Pro_ID', 'Pro_Name','Pro_img', 'Pro_Price', 'Pro_Type','Pro_Count')
                    ->orderBy('proupdated_at', 'desc')
                    ->where('Pro_Type', '=', $_GET['type'])
                    ->limit(4)
                    ->get();



        return view('user.product',[
          'products' => $product
        ]);
      }

      if (isset($_GET['q'])) {
$keyword = $_GET['q'];
        $product = \App\product::select('Pro_ID', 'Pro_Name','Pro_img', 'Pro_Price', 'Pro_Type','Pro_Count')
                    ->orderBy('proupdated_at', 'desc')
                    ->where('Pro_Name', 'LIKE', "%$keyword%")
                    ->limit(4)
                    ->get();

          Session::put("search",$_GET['q']);

        return view('user.product',[
          'products' => $product
        ]);
      }

      Session::forget('tabmanu');
      Session::put("tabmanu1","active");
      Session::put("search","ค้นหา");
      $product = \App\product::select('Pro_ID', 'Pro_Name','Pro_img', 'Pro_Price', 'Pro_Type','Pro_Count')
                  ->orderBy('proupdated_at', 'desc')->limit(4)->get();
$qtv = $product[0]->Pro_Count;

      return view('user.product',[
        'products' => $product
      ]);

  }

}
