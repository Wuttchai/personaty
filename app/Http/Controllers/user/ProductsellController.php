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
      $time =Carbon::now('Asia/Bangkok');
    
      Session::forget('tabmanu');
      Session::forget('tabmanu2');
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
