<?php

namespace App\Http\Controllers\Official;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Intervention\Image\ImageManager ;

class HotnewController extends Controller
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
       $info = \App\hotnews::join('log','hotnews.Log_ID','=','log.Log_ID')
                   ->join('official', 'official.official_ID', '=', 'log.official_ID')
                   ->select('official.official_Name', 'hotnews.Hotnews_Name', 'hotnews.hotupdated_at','hotnews.Hotnews_img','hotnews.datelast','hotnews.Hotnews_ID','hotnews.Hotnews_type')
                   ->get();


     		return response()->json($info);
     	}



     public function insert(Request $request)
     {

       $request->detail= str_replace("\n", "", "$request->detail");


    $validator =  Validator::make($request->all(), [
         'id' => 'required|string',
         'name' => 'required|string',
        'fileoffice' => 'required|image64:jpeg,jpg,png',
        'detail' => 'required|string',
        'type' => 'required|string',
        'datefirst' => 'required|string',
        'datelast' => 'string',

           ]);

           if($validator->fails()){

                 return[
                 'messages' => $validator->errors()->messages()
                 ];
               }else {




                 $imageData = $request->get('fileoffice');
       $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
     \Image::make($imageData)->save(public_path('hotnew/').$fileName);


$time =Carbon::now('Asia/Bangkok');
    \App\log::insert([
      'official_ID' => $request->id,
      'table_log' => 'ข้อมูลข่าวประชาสัมพันธ์',
      'project_log' => '0',
      'Log_Event' => 'เพิ่มข้อมูล',
      'Log_IP'  => \Request::ip(),
      'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
]);

                $logid =  \App\log::where([
                    ['official_ID', '=', $request->id],
                    ])->max('Log_ID');



                \App\hotnews::insert([
                              'Log_ID' => $logid,
                              'Hotnews_Name' => $request->name,
                              'Hotnews_detail' => $request->detail,
                              'Hotnews_img'  => $fileName,
                              'Hotnews_type' => $request->type,
                              'datefirst' => $request->datefirst,
                              'datelast' => $request->datelast,
                              'hotcreated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "" ,
                              'hotupdated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                            ]);
                $projectlog =  \App\hotnews::where([
                                ['Log_ID', '=', $logid],
                                ])->max('Hotnews_ID');

                \App\log::where('Log_ID',$logid)
                                      ->update([
                                      'project_log' => $projectlog,


                                  ]);




               }





     }
     public function showedit($id) {

       $infoedit = \App\hotnews::join('log','hotnews.Log_ID','=','log.Log_ID')
                   ->join('official', 'official.official_ID', '=', 'log.official_ID')
                   ->select('official.official_ID','hotnews.Hotnews_type', 'hotnews.Hotnews_Name','hotnews.Hotnews_img','hotnews.Hotnews_detail','hotnews.Hotnews_ID','hotnews.datelast','hotnews.datefirst')
                   ->where('hotnews.Hotnews_ID','=' ,$id)
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
   'fileoffice' => 'required|image64:jpeg,jpg,png',
   'type' => 'required|string',
   'detail' => 'required|string',
   'datefirst' => 'required|string',
   'datelast' => 'string',
  ]);
  if($Validator->errors()->messages() != null){
    return[
    'messages' => $Validator->errors()->messages()
    ];
  }




  $imageData = $request->get('fileoffice');
 $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
 \Image::make($imageData)->save(public_path('hotnew/').$fileName);


//-------------




            $time =Carbon::now('Asia/Bangkok');
                \App\log::insert([
                  'official_ID' => $request->id,
                  'table_log' => 'ข้อมูลข่าวประชาสัมพันธ์',
                  'project_log' => $id,
                  'Log_Event' => 'แก้ไขข้อมูล',
                  'Log_IP'  => \Request::ip(),
                  'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
            ]);

        $logid =  \App\log::where([
            ['official_ID', '=', $request->id],
            ])->max('Log_ID');



            \App\hotnews::where('Hotnews_ID',$id)
                        ->update([
                          'Log_ID' => $logid,
                          'Hotnews_Name' => $request->name,
                          'Hotnews_detail' => $request->detail,
                          'Hotnews_img'  => $fileName,
                          'Hotnews_type' => $request->type,
                          'datefirst' => $request->datefirst,
                          'datelast' => $request->datelast,

                          'hotupdated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                        ]);






//------


}else {
  $Validator = Validator::make($request->all(),[
    'id' => 'required|string',
    'name' => 'required|string',
   'detail' => 'required|string',
   'type' => 'required|string',
   'datefirst' => 'required|string',
   'datelast' => 'string',
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
                  'table_log' => 'ข้อมูลข่าวประชาสัมพันธ์',
                  'project_log' => $id,
                  'Log_Event' => 'แก้ไขข้อมูล',
                  'Log_IP'  => \Request::ip(),
                  'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
            ]);

        $logid =  \App\log::where([
            ['official_ID', '=', $request->id],
            ])->max('Log_ID');



            \App\hotnews::where('Hotnews_ID',$id)
                        ->update([
                          'Log_ID' => $logid,
                          'Hotnews_Name' => $request->name,
                          'Hotnews_detail' => $request->detail,
                          'datefirst' => $request->datefirst,
                          'datelast' => $request->datelast,
                          'Hotnews_type' => $request->type,
                          'hotupdated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                        ]);


}



     }


     public function delete(Request $request,$id)
     {

       $time =Carbon::now('Asia/Bangkok');
         \App\log::insert([
         'official_ID' => $request->id,
         'table_log' => 'ข้อมูลข่าวประชาสัมพันธ์',
         'project_log' => $id,
         'Log_Event' => 'ลบข้อมูล',
         'Log_IP'  => \Request::ip(),
         'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
         ]);

     \App\hotnews::where('Hotnews_ID', '=', $id)->delete();

     $info = \App\hotnews::join('log','hotnews.Log_ID','=','log.Log_ID')
                 ->join('official', 'official.official_ID', '=', 'log.official_ID')
                 ->select('official.official_Name', 'hotnews.Hotnews_Name', 'hotnews.hotupdated_at','hotnews.Hotnews_img','hotnews.datelast','hotnews.Hotnews_ID')
                 ->get();


     return response()->json($info);



     }

    public function index()
    {

      return view('official.officialhotnew');

    }



}
