<?php

namespace App\Http\Controllers\Official;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Intervention\Image\ImageManager ;

class OfficeformController extends Controller
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
       $info = \App\info::join('log','info.Log_ID','=','log.Log_ID')
                   ->join('official', 'official.official_ID', '=', 'log.official_ID')
                   ->select('official.official_Name', 'info.Info_Name', 'info.Info_up','info.Info_Img','info.Info_ID','info.Info_status','official.official_ID')
                   ->orderBy('info.Info_up', 'desc')
                   ->get();


     		return response()->json($info);
     	}



     public function insert(Request $request)
     {

    $validator =  Validator::make($request->all(), [
         'id' => 'required|string',
         'name' => 'required|regex:/^([a-zA-Z0-9ก-ูเ-๋๑-๙])/',
        'fileoffice' => 'required|image64:jpeg,jpg,png|img_min_size:1100,400'

           ]);

           if($validator->fails()){

                 return[
                 'messages' => $validator->errors()->messages()
                 ];
               }else {




                 $imageData = $request->get('fileoffice');

       $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
     \Image::make($imageData)->resize(1169, 487)->save(public_path('images/').$fileName);

$time =Carbon::now('Asia/Bangkok');
    \App\log::insert([
      'official_ID' => $request->id,
      'table_log' => 'ข้อมูลภาพแบรน์เนอร์',
      'project_log' => '0',
      'Log_Event' => 'เพิ่มข้อมูล',
      'Log_IP'  => \Request::ip(),
      'Log_Time'  => "" . $time->day. "-" . $time->month . "-" . $time->year . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
]);

                $logid =  \App\log::where([
                    ['official_ID', '=', $request->id],
                    ])->max('Log_ID');



                \App\info::insert([
                              'Log_ID' => $logid,
                              'Info_Name' => $request->name,
                              'Info_Img'  => $fileName,
                              'Info_status' => '-',
                              'Info_cre' =>"" . $time->day. "-" . $time->month . "-" . $time->year . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "" ,
                              'Info_up' =>"" . $time->day. "-" . $time->month . "-" . $time->year . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                            ]);
                $projectlog =  \App\info::where([
                                ['Log_ID', '=', $logid],
                                ])->max('Info_ID');

                \App\log::where('Log_ID',$logid)
                                      ->update([
                                      'project_log' => $projectlog,


                                  ]);




               }





     }
     public function showedit($id) {
       $infoedit = \App\info::join('log','info.Log_ID','=','log.Log_ID')
                   ->join('official', 'official.official_ID', '=', 'log.official_ID')
                   ->select('official.official_ID', 'info.Info_Name','info.Info_Img','info.Info_ID')
                   ->where('info.Info_ID','=' ,$id)
                   ->get();

        return response()->json($infoedit);
      }

     public function update(Request $request,$id)
     {
$time =Carbon::now('Asia/Bangkok');

if ($request->fileoffice) {
  $Validator = Validator::make($request->all(),[
    'id' => 'required|string',
    'name' => 'required|regex:/^([a-zA-Z0-9ก-ูเ-๋๑-๙])/',
   'fileoffice' => 'required|image64:jpeg,jpg,png|img_min_size:1100,400'
  ]);
  if($Validator->errors()->messages() != null){
    return[
    'messages' => $Validator->errors()->messages()
    ];
  }



  $imagedel = \App\info::select('Info_Img')
              ->where('Info_ID','=',$id)
              ->get();

  $image_path = "images/".$imagedel[0]->Info_Img."";



  $imageData = $request->get('fileoffice');
 $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
 \Image::make($imageData)->resize(1169, 487)->save(public_path('images/').$fileName);


//-------------




            $time =Carbon::now('Asia/Bangkok');
                \App\log::insert([
                  'official_ID' => $request->id,
                  'table_log' => 'ข้อมูลภาพแบรน์เนอร์',
                  'project_log' => '0',
                  'Log_Event' => 'แก้ไขข้อมูล',
                  'Log_IP'  => \Request::ip(),
                  'Log_Time'  => "" . $time->day. "-" . $time->month . "-" . $time->year . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
            ]);

        $logid =  \App\log::where([
            ['official_ID', '=', $request->id],
            ])->max('Log_ID');



            \App\info::where('Info_ID',$id)
                        ->update([
                          'Log_ID' => $logid,
                          'Info_Name' => $request->name,
                          'Info_Img'  => $fileName,
                          'Info_status' => '-',
                          'Info_up' =>"" . $time->day. "-" . $time->month . "-" . $time->year . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                        ]);



      \App\log::where('Log_ID',$logid)
      ->update([
      'project_log' => $id,


  ]);

//------


}else {
  $Validator = Validator::make($request->all(),[
    'id' => 'required|string',
    'name' => 'required|regex:/^([a-zA-Z0-9ก-ูเ-๋๑-๙])/',
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
                  'table_log' => 'ข้อมูลภาพแบรน์เนอร์',
                  'project_log' => '0',
                  'Log_Event' => 'แก้ไขข้อมูล',
                  'Log_IP'  => \Request::ip(),
                  'Log_Time'  => "" . $time->day. "-" . $time->month . "-" . $time->year . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
            ]);

        $logid =  \App\log::where([
            ['official_ID', '=', $request->id],
            ])->max('Log_ID');



            \App\info::where('Info_ID',$id)
                        ->update([
                          'Log_ID' => $logid,
                          'Info_Name' => $request->name,
                          'Info_status' => '-',
                          'Info_up' =>"" . $time->day. "-" . $time->month . "-" . $time->year . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                        ]);



      \App\log::where('Log_ID',$logid)
      ->update([
      'project_log' => $id,
  ]);
}



     }


     public function delete(Request $request,$id)
     {

       $time =Carbon::now('Asia/Bangkok');
         \App\log::insert([
         'official_ID' => $request->id,
         'table_log' => 'ข้อมูลภาพแบรน์เนอร์',
         'project_log' => $id,
         'Log_Event' => 'ลบข้อมูล',
         'Log_IP'  => \Request::ip(),
         'Log_Time'  => "" . $time->day. "-" . $time->month . "-" . $time->year . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
         ]);

         $imagedel = \App\info::select('Info_Img')
                     ->where('Info_ID','=',$id)
                     ->get();

         $image_path = "images/".$imagedel[0]->Info_Img."";

     \App\info::where('Info_ID', '=', $id)->delete();

     $info = \App\info::join('log','info.Log_ID','=','log.Log_ID')
                 ->join('official', 'official.official_ID', '=', 'log.official_ID')
                 ->select('official.official_Name', 'info.Info_Name', 'info.Info_up','info.Info_Img','info.Info_ID')
                 ->get();


     return response()->json($info);



     }

     public function updatestatus(Request $request,$id)
     {

        $time =Carbon::now('Asia/Bangkok');

       \App\log::insert([
         'official_ID' => $request->id,
         'table_log' => 'ข้อมูลภาพแบรน์เนอร์',
         'project_log' => $id,
         'Log_Event' => 'แก้ไขสถานะการโชว์',
         'Log_IP'  => \Request::ip(),
         'Log_Time'  => "" . $time->day. "-" . $time->month . "-" . $time->year . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
     ]);

     $logid =  \App\log::where([
     ['official_ID', '=', $request->id],
     ])->max('Log_ID');

     \App\info::where('Info_ID',$id)
               ->update([
                 'Log_ID' => $logid,
                 'Info_status' => $request->status,
               ]);



     }
    public function index()
    {


  return view('official.officialform');

    }



}
