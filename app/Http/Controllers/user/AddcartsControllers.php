<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use \Cart as Cart;
use Illuminate\Support\Facades\Auth;

class AddcartsControllers extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
  $this->middleware('auth');
  $this->middleware('cheackcar');
     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


     public function confrim(Request $request)
     {


       $time =Carbon::now('Asia/Bangkok');

       \App\product_sell::insert([
                     'User_ID' => Auth::user()->User_ID,
                     'Prosell_Quantity' => 0,
                     'Prosell_totalPirce'  => 0,
                     'Prosell_send' => '',
                     'Prosell_img' => '',
                     'Prosell_orderdate' => '',
                     'Prosell_creat'=>   "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                     ]);
                     $Prosell_ID =  \App\product_sell::where([
                         ['User_ID', '=', Auth::user()->User_ID],
                         ])->max('Prosell_ID');

     $num =0;
     $Quantity = 0;
     $totalPirce =0;
     foreach(Cart::content() as $carcon) {

       \App\sell_detail::insert([
                     'Pro_ID' => $carcon->id,
                     'Prosell_ID'=>$Prosell_ID,
                     'Det_Num'  => $carcon->qty,
                     'Det_total' => $carcon->qty * $carcon->price
                     ]);
       $num ++;
       $Quantity += $carcon->qty;
       $totalPirce += $carcon->qty * $carcon->price;
}

\App\product_sell::where('Prosell_ID',$Prosell_ID)
            ->update([
              'Prosell_Quantity' => $Quantity,
              'Prosell_totalPirce'  => $totalPirce,
            ]);
          

  return view('user.showcars',[

    'Prosell_ID' => $Prosell_ID
  ]);

     }



    public function index()
    {

      return view('user.showcars');
}

}
