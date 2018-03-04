<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use \Cart as Cart;


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



Cart::add($request->id, $product[0]->Pro_Name, $request->quantity, $product[0]->Pro_Price);


     }

     public function deletecars(Request $request)
     {
       Cart::remove($request->id);


     }

    public function index()
    {
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
