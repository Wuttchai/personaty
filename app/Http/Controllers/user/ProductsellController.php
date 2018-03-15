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
     public function ProductCarOrders()
     {
       Session::forget('tabmanu');
         Session::forget('tabmanu1');
       Session::forget("tabmanu2");
       Session::put("tabmanu3","active");
       $CarOrders = \App\product_sell::select('Prosell_ID', 'Prosell_Quantity','Prosell_totalPirce', 'Prosell_creat')
                   ->where('User_ID','=' ,Auth::user()->User_ID)
                   ->paginate(10);
                   return view('user.detailuser',[
                     'CarOrders' => $CarOrders
                   ]);
     }
     public function ProductCardetail($id)
     {

       $Car = \App\product_sell::join('sell_detail','product_sell.Prosell_ID','=','sell_detail.Prosell_ID')
                   ->join('product','product.Pro_ID','=','sell_detail.Pro_ID')
                   ->select('product.Pro_Name','sell_detail.Det_Num', 'product.Pro_Price')
                   ->where('sell_detail.Prosell_ID','=' ,$id)
                   ->get();

                   $date = \App\product_sell::select('Prosell_ID','Prosell_creat')
                               ->where('Prosell_ID','=' ,$id)
                               ->get();


return view('user.detailcars',[
  'Car' => $Car,
  'date' => $date,
]);
}
public function insertimg(Request $request)
     {
dd($request);
       $validator =  Validator::make($request->all(), [
            'id' => 'required',
           'fileoffice' => 'required|image64:jpeg,jpg,png|img_min_size:100,100',
              ]);

              if($validator->fails()){

                    return[
                    'messages' => $validator->errors()->messages()
                    ];
                  }else {

                    $imageData = $request->get('fileoffice');
                   $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                   \Image::make($imageData)->resize(500, 800)->save(public_path('Receipt/').$fileName);


       $time =Carbon::now('Asia/Bangkok');



           \App\product_sell::where('Prosell_ID',$request->id)
                                 ->update([
                                 'Prosell_img' => $fileName,
                                 'Prosell_orderdate'=>   "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                             ]);

           $CarOrders = \App\product_sell::select('Prosell_ID', 'Prosell_Quantity','Prosell_totalPirce', 'Prosell_creat')
                       ->where('User_ID','=' ,Auth::user()->User_ID)
                       ->paginate(10);


foreach(Cart::content() as $carcon) {

  Cart::remove($carcon->rowId);
}

 return redirect()->route('ProductCarOrders', ['CarOrders' => $CarOrders]);
}
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
