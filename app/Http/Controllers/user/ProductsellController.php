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


     public function addcars(Request $request)
     {


  $product = \App\product::select('Pro_ID', 'Pro_Name', 'Pro_Price')
             ->where('Pro_ID','=' , $request->id)
             ->get();



$ss =Cart::add($request->id, $product[0]->Pro_Name, $request->quantity, $product[0]->Pro_Price);


     }

    public function index()
    {
      Session::forget('tabmanu');
      Session::put("tabmanu1","active");
      $product = \App\product::select('Pro_ID', 'Pro_Name','Pro_img', 'Pro_Price', 'Pro_Type')
                  ->orderBy('proupdated_at', 'desc')->limit(4)->get();

      return view('user.product',[
        'products' => $product
      ]);

    }
}
