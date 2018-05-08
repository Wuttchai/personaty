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
                                      'Prosell_orderdate'=>   "" . $time->day. "-" . $time->month . "-" . $time->year . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                                  ]);


                            foreach(Cart::content() as $carcon) {

                              Cart::remove($carcon->rowId);
                            }
                            Session::forget('car');



     }
          }

          public function datailuser()
          {
            $user = \App\User::select('User_ID', 'User_Name', 'email')
                       ->where('User_ID','=' , Auth::user()->User_ID)
                       ->get();
                       $userid = \App\address::select('address_id')
                                  ->where('address.User_ID','=' , Auth::user()->User_ID)
                                  ->min('address.address_id');
                      $userdetail = \App\address::select('address_name','address_at','address_tumbon','address_aumpor','address_province','address_zipcode','address_tel')
                                 ->where('address.address_id','=' , $userid)
                                 ->get();

        return view('user.infouser',[
          'user'=>$user,
          'userdetail'=>$userdetail
         ]);

        }
        public function editdatailuser(Request $request)
        {
          if ($request->email == Auth::user()->email) {
            Validator::make($request->all(), [
              'User_Name' => 'required|regex:/^([a-zA-Zก-ูเ-๋])/|min:5|max:255',
              'User_Address' => 'required|regex:/^([a-zA-Z0-9ก-ูเ-๋๑-๙])/',
              'User_Tel'=>'required|numeric|digits:10',
              'tumbon'  => 'required|regex:/^([ก-ูเ-๋])/',
              'aumpor'  => 'required|regex:/^([ก-ูเ-๋])/',
              'province' => 'required|regex:/^([ก-ูเ-๋])/',
              'zipcode' => 'required|numeric|digits:5'
        ])->validate();
      }else {
        Validator::make($request->all(), [
          'User_Name' => 'required|regex:/^([a-zA-Zก-ูเ-๋])/|min:5|max:255',
  'email' => 'required|string|email|max:255|unique:users,email',
  'User_Address' => 'required|regex:/^([a-zA-Z0-9ก-ูเ-๋๑-๙])/',
  'User_Tel'=>'required|numeric|digits:10',
  'tumbon'  => 'required|regex:/^([ก-ูเ-๋])/',
  'aumpor'  => 'required|regex:/^([ก-ูเ-๋])/',
  'province' => 'required|regex:/^([ก-ูเ-๋])/',
  'zipcode' => 'required|numeric|digits:5'
    ])->validate();
      }

      \App\User::where('User_ID',Auth::user()->User_ID)
                  ->update([
                    'User_Name' => $request->User_Name,
                    'email' => $request->email,
                  ]);
     \App\address::where('User_ID',Auth::user()->User_ID)
                 ->update([
                   'address_name' => $request->User_Name,
                   'address_at' => $request->User_Address,
                   'address_tumbon' => $request->tumbon,
                   'address_aumpor' => $request->aumpor,
                   'address_province' => $request->province,
                   'address_zipcode' => $request->zipcode,
                   'address_tel'   => $request->User_Tel,
                 ]);




return redirect()->route('showdatailuser')->with('alert', 'แก้ไขข้อมูลเรียบร้อย!');


      }
    public function index()
    {

      return redirect('/ProductAyutaya');
    }

}
