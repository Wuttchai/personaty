<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use \Cart as Cart;
use Illuminate\Support\Facades\Auth;

class AddimgcarController extends Controller
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


     public function insertimg(Request $request)
          {


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
                        \Image::make($imageData)->resize(500, 800)->save(public_path('ProductCardetail/').$fileName);


            $time =Carbon::now('Asia/Bangkok');



                \App\product_sell::where('Prosell_ID',$request->id)
                                      ->update([
                                      'Prosell_img' => $fileName,
                                      'Prosell_send' => 'ชำระเงิน',
                                      'Prosell_about' => 'กรุณารอเจ้าหน้าที่ตรวจสอบ',
                                      'Prosell_orderdate'=>   "" . $time->day. "-" . $time->month . "-" . $time->year . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                                  ]);


                            foreach(Cart::content() as $carcon) {

                              Cart::remove($carcon->rowId);
                            }
                            Session::forget('car');



     }
          }


    public function index()
    {

      return redirect('/ProductAyutaya');
}

}
