<?php

namespace App\Http\Controllers\Official;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Intervention\Image\ImageManager ;

class PersonController extends Controller
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
       $info = \App\person::join('log','person.Log_ID','=','log.Log_ID')
                   ->join('official', 'official.official_ID', '=', 'log.official_ID')
                   ->select('official.official_Name', 'person.Person_Type', 'person.Person_Num','person.perupdated_at','person.Person_ID','official.official_ID')
                   ->get();


     		return response()->json($info);
     	}



     public function insert(Request $request)
     {

    $validator =  Validator::make($request->all(), [
         'id' => 'required|string',
         'name' => 'required|string',
        'fileoffice' => 'required|image64:jpeg,jpg,png'

           ]);

           if($validator->fails()){

                 return[
                 'messages' => $validator->errors()->messages()
                 ];
               }else {




                 $imageData = $request->get('fileoffice');
       $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
     \Image::make($imageData)->save(public_path('images/').$fileName);


$time =Carbon::now('Asia/Bangkok');
    \App\log::insert([
      'official_ID' => $request->id,
      'table_log' => 'info',
      'project_log' => '0',
      'Log_Event' => 'เพิ่ม',
      'Log_IP'  => \Request::ip(),
      'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
]);

                $logid =  \App\log::where([
                    ['official_ID', '=', $request->id],
                    ])->max('Log_ID');



                \App\info::insert([
                              'Log_ID' => $logid,
                              'Info_Name' => $request->name,
                              'Info_Img'  => $fileName,
                              'infocreated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "" ,
                              'Infoupdated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
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
    'name' => 'required|string',
   'fileoffice' => 'required|image64:jpeg,jpg,png'
  ]);
  if($Validator->errors()->messages() != null){
    return[
    'messages' => $Validator->errors()->messages()
    ];
  }




  $imageData = $request->get('fileoffice');
 $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
 \Image::make($imageData)->save(public_path('images/').$fileName);


//-------------




            $time =Carbon::now('Asia/Bangkok');
                \App\log::insert([
                  'official_ID' => $request->id,
                  'table_log' => 'info',
                  'project_log' => '0',
                  'Log_Event' => 'แก้ไข',
                  'Log_IP'  => \Request::ip(),
                  'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
            ]);

        $logid =  \App\log::where([
            ['official_ID', '=', $request->id],
            ])->max('Log_ID');



            \App\info::where('Info_ID',$id)
                        ->update([
                          'Log_ID' => $logid,
                          'Info_Name' => $request->name,
                          'Info_Img'  => $fileName,
                          'Infoupdated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                        ]);



      \App\log::where('Log_ID',$logid)
      ->update([
      'project_log' => $id,


  ]);

//------


}else {
  $Validator = Validator::make($request->all(),[
    'id' => 'required|string',
    'name' => 'required|string',
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
                  'table_log' => 'info',
                  'project_log' => '0',
                  'Log_Event' => 'แก้ไข',
                  'Log_IP'  => \Request::ip(),
                  'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
            ]);

        $logid =  \App\log::where([
            ['official_ID', '=', $request->id],
            ])->max('Log_ID');



            \App\info::where('Info_ID',$id)
                        ->update([
                          'Log_ID' => $logid,
                          'Info_Name' => $request->name,
                          'Infoupdated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
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
         'table_log' => 'official',
         'project_log' => $id,
         'Log_Event' => 'ลบ',
         'Log_IP'  => \Request::ip(),
         'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
         ]);

     \App\info::where('Info_ID', '=', $id)->delete();

     $info = \App\info::join('log','info.Log_ID','=','log.Log_ID')
                 ->join('official', 'official.official_ID', '=', 'log.official_ID')
                 ->select('official.official_Name', 'info.Info_Name', 'info.Infoupdated_at','info.Info_Img','info.Info_ID')
                 ->get();


     return response()->json($info);



     }

    public function index()
    {

      return view('official.officialperson');

    }



}
