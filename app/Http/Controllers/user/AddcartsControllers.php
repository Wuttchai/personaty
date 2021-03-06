<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DB;
use Redirect;
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
     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


     public function confrim()
     {

       $time =Carbon::now('Asia/Bangkok');
       $product = \App\product_sell::select('product_Sell.Prosell_img')
                  ->where('product_Sell.User_ID','=' , Auth::user()->User_ID)
                  ->where('product_Sell.Prosell_send','=' ,'ค้างชำระ')
                  ->get();
if ($product != '[]') {
  foreach (Cart::content() as $key1 => $product) {
    Cart::remove($product->rowId);
  }
   return Redirect::back()->with('alert', 'Profile updated!');
}




                  $userid = \App\address::select('address_id')
                             ->where('address.User_ID','=' , Auth::user()->User_ID)
                             ->max('address.address_id');
                 $userdetail = \App\address::select('address_name','address_at','address_tumbon','address_aumpor','address_province','address_zipcode','address_tel')
                            ->where('address.address_id','=' , $userid)
                            ->get();
       \App\product_sell::insert([
                     'User_ID' => Auth::user()->User_ID,
                     'address_name' => $userdetail[0]->address_name,
                     'address_at' => $userdetail[0]->address_at ,
                     'address_tumbon' => $userdetail[0]->address_tumbon  ,
                     'address_aumpor' => $userdetail[0]->address_aumpor ,
                     'address_province' => $userdetail[0]->address_province ,
                     'address_zipcode' => $userdetail[0]->address_zipcode ,
                     'address_tel' => $userdetail[0]->address_tel,
                     'Prosell_Quantity' => 0,
                     'Prosell_totalPirce'  => 0,
                     'Prosell_send' => 'ค้างชำระ',
                     'Prosell_about' => 'โปรดยืนยันการสั่งซื้อ',
                     'Prosell_img' => '-',
                     'Prosell_orderdate' => '-',
                     'Prosell_creat'=>   "" . $time->day. "-" . $time->month . "-" . $time->year . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
                     'Prosell_senddate' => '-'
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
              'Prosell_creat'=>   "" . $time->day. "-" . $time->month . "-" . $time->year . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
            ]);
            foreach (Cart::content() as $key1 => $product) {
              Cart::remove($product->rowId);
            }
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

foreach (Cart::content() as $key1 => $product) {
  Cart::remove($product->rowId);
}
       return redirect('/ProductAyutaya');
   }



    public function index()
    {

      return view('user.showcars');
}

}
