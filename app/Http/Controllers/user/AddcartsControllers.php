<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DB;
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
       $product = \App\product_sell::select('product_Sell.Prosell_img')
                  ->where('product_Sell.User_ID','=' , Auth::user()->User_ID)
                  ->where('product_Sell.Prosell_img','=' ,'-')
                  ->get();
                  $userdetail = \App\User::select('User_Name','User_Address')
                             ->where('users.User_ID','=' , Auth::user()->User_ID)
                             ->get();

       \App\product_sell::insert([
                     'User_ID' => Auth::user()->User_ID,
                     'Prosell_Quantity' => 0,
                     'Prosell_totalPirce'  => 0,
                     'Prosell_send' => '-',
                     'Prosell_img' => '-',
                     'Prosell_name' => $userdetail[0]->User_Name,
                     'Prosell_address' => $userdetail[0]->User_Address,
                     'Prosell_orderdate' => '-',
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
              'Prosell_creat'=>   "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
            ]);
            $date = DB::table('product_Sell')
            ->select('Prosell_name','Prosell_address')
            ->where('Prosell_ID','=' ,$Prosell_ID)
            ->get();
            return redirect()->route('showcar');

     }

     public function delete()
     {
       $Prosell_ID =  \App\product_sell::where([
           ['User_ID', '=', Auth::user()->User_ID],
           ])->max('Prosell_ID');

           $sell_ID =  \App\sell_detail::where([
               ['Prosell_ID', '=', $Prosell_ID],
               ])->max('Det_ID');

\App\product_sell::where('Prosell_ID', '=', $Prosell_ID)->delete();
\App\sell_detail::where('Det_ID', '=', $sell_ID)->delete();


       return redirect('/ProductAyutaya');
   }



    public function index()
    {

      return view('user.showcars');
}

}
