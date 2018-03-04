<?php

namespace App\Http\Controllers\Official;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Intervention\Image\ImageManager ;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
         $this->middleware('ckloginoffice');
     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

public $timestamps = false;

     public function readItems() {
       $info = \App\product::join('log','product.Log_ID','=','log.Log_ID')
                   ->join('official', 'official.official_ID', '=', 'log.official_ID')
                   ->select('official.official_Name','product.Pro_Name', 'product.Pro_Price', 'product.Pro_img','product.Pro_Count','product.proupdated_at','product.Pro_ID')
                   ->get();


     		return response()->json($info);
     	}


     public function insert(Request $request)
     {

    $validator =  Validator::make($request->all(), [
         'id' => 'required|string',
         'name' => 'required|string',
        'fileoffice' => 'required|image64:jpeg,jpg,png|img_min_size:250,200',
        'detail' => 'required|string',
        'type' => 'required',
        'money' => 'required|numeric',
        'count' => 'required|numeric',

           ]);

           if($validator->fails()){

                 return[
                 'messages' => $validator->errors()->messages()
                 ];
               }else {


                 $request->detail= str_replace("\n", "", "$request->detail");



                 $imageData = $request->get('fileoffice');
       $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
     \Image::make($imageData)->resize(290, 220)->save(public_path('product/').$fileName);


$time =Carbon::now('Asia/Bangkok');
    \App\log::insert([
      'official_ID' => $request->id,
      'table_log' => 'ข้อมูลสินค้าวิชาชีพ',
      'project_log' => '0',
      'Log_Event' => 'เพิ่มข้อมูล',
      'Log_IP'  => \Request::ip(),
      'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
]);

                $logid =  \App\log::where([
                    ['official_ID', '=', $request->id],
                    ])->max('Log_ID');




                \App\product::insert([
                              'Log_ID' => $logid,
                              'Pro_Name' => $request->name,
                              'Pro_Detail' => $request->detail,
                              'Pro_img'  => $fileName,
                              'Pro_Type' => $request->type,
                              'Pro_Count' => $request->count,
                              'Pro_Price' => $request->money,
                              'procreated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "" ,
                              'proupdated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                            ]);
                $projectlog =  \App\product::where([
                                ['Log_ID', '=', $logid],
                                ])->max('Pro_ID');

                \App\log::where('Log_ID',$logid)
                                      ->update([
                                      'project_log' => $projectlog,


                                  ]);




               }





     }
     public function showedit($id) {

       $infoedit = \App\product::join('log','product.Log_ID','=','log.Log_ID')
                   ->join('official', 'official.official_ID', '=', 'log.official_ID')
                   ->select('official.official_ID', 'product.Pro_Name','product.Pro_img','product.Pro_Detail','product.Pro_ID','product.Pro_Type','product.Pro_Count','product.Pro_Price')
                   ->where('product.Pro_ID','=' ,$id)
                   ->get();
        return response()->json($infoedit);
      }

     public function update(Request $request,$id)
     {

$time =Carbon::now('Asia/Bangkok');

if ($request->fileoffice) {
  $Validator = Validator::make($request->all(),[
    'id' => 'required|string',
    'name' => 'required|string',
   'fileoffice' => 'required|image64:jpeg,jpg,png|img_min_size:250,200',
   'detail' => 'required|string',
   'type' => 'required',
   'money' => 'required|numeric',
   'count' => 'required|numeric',
  ]);
  if($Validator->errors()->messages() != null){
    return[
    'messages' => $Validator->errors()->messages()
    ];
  }





  $imageData = $request->get('fileoffice');
 $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
 \Image::make($imageData)->resize(290, 220)->save(public_path('product/').$fileName);


//-------------




            $time =Carbon::now('Asia/Bangkok');
                \App\log::insert([
                  'official_ID' => $request->id,
                  'table_log' => 'ข้อมูลสินค้าวิชาชีพ',
                  'project_log' => $id,
                  'Log_Event' => 'แก้ไขข้อมูล',
                  'Log_IP'  => \Request::ip(),
                  'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
            ]);

        $logid =  \App\log::where([
            ['official_ID', '=', $request->id],
            ])->max('Log_ID');



            \App\product::where('Pro_ID',$id)
                        ->update([
                          'Log_ID' => $logid,
                          'Pro_Name' => $request->name,
                          'Pro_Detail' => $request->detail,
                          'Pro_img'  => $fileName,
                          'Pro_Type' => $request->type,
                          'Pro_Count' => $request->count,
                          'Pro_Price' => $request->money,
                          'proupdated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                        ]);






//------


}else {

  $Validator = Validator::make($request->all(),[
    'id' => 'required|string',
    'name' => 'required|string',
   'detail' => 'required|string',
   'type' => 'required',
   'money' => 'required|numeric',
   'count' => 'required|numeric',
  ]);

  if($Validator->errors()->messages() != null){
    return[
    'messages' => $Validator->errors()->messages()
    ];
  }

//-----------------
            $time =Carbon::now('Asia/Bangkok');
                \App\log::insert([
                  'official_ID' => $request->id,
                  'table_log' => 'ข้อมูลสินค้าวิชาชีพ',
                  'project_log' => $id,
                  'Log_Event' => 'แก้ไขข้อมูล',
                  'Log_IP'  => \Request::ip(),
                  'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
            ]);

        $logid =  \App\log::where([
            ['official_ID', '=', $request->id],
            ])->max('Log_ID');



            \App\product::where('Pro_ID',$id)
                        ->update([
                          'Log_ID' => $logid,
                          'Pro_Name' => $request->name,
                          'Pro_Detail' => $request->detail,
                          'Pro_Type' => $request->type,
                          'Pro_Count' => $request->count,
                          'Pro_Price' => $request->money,
                          'proupdated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                        ]);


}



     }


     public function delete(Request $request,$id)
     {

       $time =Carbon::now('Asia/Bangkok');
         \App\log::insert([
         'official_ID' => $request->id,
         'table_log' => 'ข้อมูลสินค้าวิชาชีพ',
         'project_log' => $id,
         'Log_Event' => 'ลบข้อมูล',
         'Log_IP'  => \Request::ip(),
         'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
         ]);

     \App\product::where('Pro_ID', '=', $id)->delete();

     $info = \App\product::join('log','product.Log_ID','=','log.Log_ID')
                 ->join('official', 'official.official_ID', '=', 'log.official_ID')
                 ->select('official.official_Name','product.Pro_Name', 'product.Pro_Price', 'product.Pro_img','product.Pro_Count','product.proupdated_at','product.Pro_ID')
                 ->get();


     return response()->json($info);



     }

    public function index()
    {

      return view('official.officialproduct');

    }



}
