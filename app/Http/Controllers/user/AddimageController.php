<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use \Cart as Cart;
use Illuminate\Support\Facades\Auth;

class AddimageController extends Controller
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
dd("dsdsds");
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
                        \Image::make($imageData)->resize(500, 800)->save(public_path('/ProductCardetail/Receipt/').$fileName);


            $time =Carbon::now('Asia/Bangkok');



                \App\product_sell::where('Prosell_ID',$request->id)
                                      ->update([
                                      'Prosell_img' => $fileName,
                                      'Prosell_send' => 'ชำระเงิน',
                                      'Prosell_about' => 'กรุณารอเจ้าหน้าที่ตรวจสอบ',
                                      'Prosell_orderdate'=>   "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                                  ]);


                            foreach(Cart::content() as $carcon) {

                              Cart::remove($carcon->rowId);
                            }
                            Session::forget('car');



     }
          }

          public function datailuser()
          {
            $user = \App\User::select('User_ID', 'User_Name', 'email', 'User_Address', 'User_Tel', 'User_Tel')
                       ->where('User_ID','=' , Auth::user()->User_ID)
                       ->get();


        return view('user.infouser',[
          'user'=>$user
         ]);

        }
        public function editdatailuser(Request $request)
        {
          if ($request->email == Auth::user()->email) {
            Validator::make($request->all(), [
              'User_Name' => 'required|regex:/^([a-zA-Z0-9ก-ูเ-๋๑-๙])/|max:255',
              'User_Address' => 'required|regex:/^([a-zA-Z0-9ก-ูเ-๋๑-๙])/',
              'User_Tel'=>'required|numeric'
        ])->validate();
      }else {
        Validator::make($request->all(), [
          'User_Name' => 'required|regex:/^([a-zA-Z0-9ก-ูเ-๋๑-๙])/|max:255',
  'email' => 'required|string|email|max:255|unique:users,email',
  'User_Address' => 'required|regex:/^([a-zA-Z0-9ก-ูเ-๋๑-๙])/',
  'User_Tel'=>'required|numeric'
    ])->validate();
      }

      \App\User::where('User_ID',Auth::user()->User_ID)
                  ->update([
                    'User_Name' => $request->User_Name,
                    'email' => $request->email,
                    'User_Address'  => $request->User_Address,
                    'User_Tel' =>$request->User_Tel
                  ]);




return redirect()->route('showdatailuser')->with('alert', 'แก้ไขข้อมูลเรียบร้อย!');


      }
    public function index()
    {

      return redirect('/ProductAyutaya');
    }

}
