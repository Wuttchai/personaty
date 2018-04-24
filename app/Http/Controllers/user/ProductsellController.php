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

              $addressid = DB::table('product_Sell')
                          ->select('Prosell_ID','Prosell_creat','Prosell_orderdate','Prosell_creat','Prosell_img','Prosell_send','Prosell_Quantity','address_id')
                          ->where('Prosell_ID','=' ,$id)
                          ->where('User_ID','=',Auth::user()->User_ID)
                          ->get();

$address = DB::table('address')
            ->select('address_name','address_at','address_tumbon','address_aumpor','address_province','address_zipcode','address_tel')
            ->where('address_id','=' ,$addressid[0]->address_id)
            ->get();


        $address = DB::table('product_Sell')
                      ->select('address_name','address_at','address_tumbon','address_aumpor','address_province','address_zipcode','address_tel')
                      ->where('sell_detail.Prosell_ID','=' ,$id)
                      ->get();

return view('user.insrtimgcar',[
'Car' => $Car,
'date' => $date,
'address' => $address,
]);
}
public function ProductCarorderdelete($id)
{


\App\product_sell::where('Prosell_ID', '=', $id)->delete();

return redirect('/ProductCarOrders');


}

public function editdropdown(Request $request,$id)
{
  $address = DB::table('address')
              ->select('address_name','address_at','address_tumbon','address_aumpor','address_province','address_zipcode','address_tel')
              ->where('address_id','=' ,$request->idaddres)
              ->get();

  \App\product_sell::where('Prosell_ID',$id)
              ->update([
                'address_name' => $address[0]->address_name,
                'address_at' => $address[0]->address_at,
                'address_tumbon'  => $address[0]->address_tumbon,
                'address_aumpor' => $address[0]->address_aumpor,
                'address_province' => $address[0]->address_province,
                'address_zipcode' => $address[0]->address_zipcode,
                'address_tel' =>$address[0]->address_tel,
            ]);



}
public function editsend(Request $request ,$id)
{


  $validator = Validator::make($request->all(), [
        'name' => 'required|regex:/^([a-zA-Zก-ูเ-๋])/|min:5|max:255',
        'address' => 'required',
        'tumbon'  => 'required|regex:/^([ก-ูเ-๋])/',
        'aumpor'  => 'required|regex:/^([ก-ูเ-๋])/',
        'province' => 'required|regex:/^([ก-ูเ-๋])/',
        'zipcode' => 'required|numeric|digits:5',
        'tel' => 'required|numeric|digits:10',
    ]);

    if($validator->fails()){

          return[
          'messages' => $validator->errors()->messages()
          ];
        }else {

          \App\address::insert([
                        'User_ID' => Auth::user()->User_ID,
                        'address_name' => $request->name,
                        'address_at' => $request->address,
                        'address_tumbon'  => $request->tumbon,
                        'address_aumpor' => $request->aumpor,
                        'address_province' => $request->province,
                        'address_zipcode' => $request->zipcode,
                        'address_tel' =>$request->tel,
                        ]);
                        $address = \App\address::where('User_ID',Auth::user()->User_ID)
                        ->max('address_id');

                                \App\product_sell::where('Prosell_ID',$id)
                                            ->update([
                                              'address_name' => $request->name,
                                              'address_at' => $request->address,
                                              'address_tumbon'  => $request->tumbon,
                                              'address_aumpor' => $request->aumpor,
                                              'address_province' => $request->province,
                                              'address_zipcode' => $request->zipcode,
                                              'address_tel' =>$request->tel,
                                          ]);
        }



}

public function showaddres()
{

  $address = \App\address::select('address_id','address_name','address_at','address_tumbon','address_aumpor','address_province','address_zipcode','address_tel')
              ->where('User_ID','=' ,Auth::user()->User_ID)
              ->orderBy('address_id', 'desc')
              ->get();


return response()->json($address);

}
public function showinfo($id)
{

  $address = \App\address::select('address_name','address_at','address_tumbon','address_aumpor','address_province','address_zipcode','address_tel')
              ->where('address_id','=' ,$id)
              ->get();


return response()->json($address);

}

public function infoaddress($id ,Request $request)
{
  $validator = Validator::make($request->all(), [
        'name' => 'required|regex:/^([a-zA-Zก-ูเ-๋])/|min:5|max:255',
        'address' => 'required',
        'tumbon'  => 'required|regex:/^([ก-ูเ-๋])/',
        'aumpor'  => 'required|regex:/^([ก-ูเ-๋])/',
        'province' => 'required|regex:/^([ก-ูเ-๋])/',
        'zipcode' => 'required|numeric|digits:5',
        'tel' => 'required|numeric|digits:10',
    ]);

    if($validator->fails()){

          return[
          'messages' => $validator->errors()->messages()
          ];
        }else {

                                \App\product_sell::where('Prosell_ID',$id)
                                            ->update([
                                              'address_name' => $request->name,
                                              'address_at' => $request->address,
                                              'address_tumbon'  => $request->tumbon,
                                              'address_aumpor' => $request->aumpor,
                                              'address_province' => $request->province,
                                              'address_zipcode' => $request->zipcode,
                                              'address_tel' =>$request->tel,
                                          ]);

                                          \App\address::where('address_id',$request->idaddress)
                                                      ->update([
                                                        'address_name' => $request->name,
                                                        'address_at' => $request->address,
                                                        'address_tumbon'  => $request->tumbon,
                                                        'address_aumpor' => $request->aumpor,
                                                        'address_province' => $request->province,
                                                        'address_zipcode' => $request->zipcode,
                                                        'address_tel' =>$request->tel,
                                                        ]);

}

}
public function deleteinfo($id)
{

  $address = \App\address::select('address_name')
              ->where('User_ID','=' ,Auth::user()->User_ID)
              ->get();
$addresscount =  count($address);
if ($addresscount == 1) {
  $error ='true';

  return response()->json($error);
}else {
  \App\address::where('address_id', '=', $id)->delete();

}



}

public function index()
{
  $Car2 = DB::table('product_Sell')
              ->join('sell_detail','product_Sell.Prosell_ID','=','sell_detail.Prosell_ID')
              ->join('product','product.Pro_ID','=','sell_detail.Pro_ID')
              ->select('product.Pro_Name','sell_detail.Det_Num', 'product.Pro_Price','product_Sell.Prosell_ID')
              ->where('product_Sell.User_ID','=' ,Auth::user()->User_ID)
              ->max('product_Sell.Prosell_ID', 'desc');

              $Car = DB::table('product_Sell')
                          ->join('sell_detail','product_Sell.Prosell_ID','=','sell_detail.Prosell_ID')
                          ->join('product','product.Pro_ID','=','sell_detail.Pro_ID')
                          ->select('product.Pro_Name','sell_detail.Det_total','sell_detail.Det_Num', 'product.Pro_Price','product_Sell.Prosell_ID')
                          ->where('product_Sell.Prosell_ID','=' ,$Car2)
                          ->get();


  $Prosell_ID =  \App\product_sell::where([
      ['User_ID', '=', Auth::user()->User_ID],
      ])->max('Prosell_ID');


  $userdetail = DB::table('product_Sell')
                ->select('address_name','address_at','address_tumbon','address_aumpor','address_province','address_zipcode','address_tel')
                ->where('product_Sell.Prosell_ID','=' ,$Prosell_ID)
                ->get();



return view('user.showcars',[
  'userdetail' => $userdetail,
  'Prosell_ID' => $Prosell_ID,
  'Car' => $Car

  ]);

}
}
