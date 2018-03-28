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
       $info = \App\person::join('log','person_count.Log_ID','=','log.Log_ID')
                   ->join('official', 'official.official_ID', '=', 'log.official_ID')
                   ->select('official.official_Name', 'person_count.Person_Type', 'person_count.Person_Num','person_count.perupdated_at','person_count.Person_ID','official.official_ID')
                   ->orderBy('person_count.perupdated_at', 'desc')
                    ->get();


     		return response()->json($info);
     	}



     public function insert(Request $request)
     {

if ($request->count == 'ประวัติความเป็นมา' || $request->count == 'วิสัยทัศน์และพันธกิจ'   || $request->count == 'ยุทธศาสตร์') {
  $validator =  Validator::make($request->all(), [
       'id' => 'required|string',
       'name' => 'required|string|unique:person_count,Person_Type',
      'count' => 'required|string'

         ]);

         if($validator->fails()){

               return[
               'messages' => $validator->errors()->messages()
               ];
             }else {






$time =Carbon::now('Asia/Bangkok');
  \App\log::insert([
    'official_ID' => $request->id,
    'table_log' => "ข้อมูล" . $request->count. "",
    'project_log' => '0',
    'Log_Event' => 'เพิ่มข้อมูล',
    'Log_IP'  => \Request::ip(),
    'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
]);

              $logid =  \App\log::where([
                  ['official_ID', '=', $request->id],
                  ])->max('Log_ID');



              \App\person::insert([
                            'Log_ID' => $logid,
                            'Person_Type' => $request->count,
                            'Person_Num'  => $request->name,
                            'percreated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "" ,
                            'perupdated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                          ]);
              $projectlog =  \App\person::where([
                              ['Log_ID', '=', $logid],
                              ])->max('Person_ID');
              \App\log::where('Log_ID',$logid)
                                    ->update([
                                    'project_log' => $projectlog,
                                ]);
             }

}else {
$validator =  Validator::make($request->all(), [
  'id' => 'required|string',
  'name' => 'required|string|unique:person_count,Person_Type|image64:jpeg,jpg,png|img_min_size:1000,500',
 'count' => 'required|string'

    ]);

    if($validator->fails()){

          return[
          'messages' => $validator->errors()->messages()
          ];
        }else {
          $imageData = $request->get('name');
          $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
          \Image::make($imageData)->resize(1366, 769)->save(public_path('about/').$fileName);


$time =Carbon::now('Asia/Bangkok');
\App\log::insert([
'official_ID' => $request->id,
'table_log' => "ข้อมูล" . $request->count. "",
'project_log' => '0',
'Log_Event' => 'เพิ่มข้อมูล',
'Log_IP'  => \Request::ip(),
'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
]);
         $logid =  \App\log::where([
             ['official_ID', '=', $request->id],
             ])->max('Log_ID');
         \App\person::insert([
                       'Log_ID' => $logid,
                       'Person_Type' => $request->count,
                       'Person_Num'  => $fileName,
                       'percreated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "" ,
                       'perupdated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                     ]);
         $projectlog =  \App\person::where([
                         ['Log_ID', '=', $logid],
                         ])->max('Person_ID');
         \App\log::where('Log_ID',$logid)
                               ->update([
                               'project_log' => $projectlog,
                           ]);
        }


}






     }
     public function showedit($id) {

       $info = \App\person::join('log','person_count.Log_ID','=','log.Log_ID')
                   ->join('official', 'official.official_ID', '=', 'log.official_ID')
                   ->select('official.official_ID','person_count.Person_Type','person_count.Person_Num','person_count.Person_ID')
                   ->where('person_count.Person_ID','=' ,$id)
                   ->get();


        return response()->json($info);
      }

     public function update(Request $request,$id)
     {
         $time =Carbon::now('Asia/Bangkok');
if ($request->img && $request->name) {

}
if ($request->img) {
  $Validator = Validator::make($request->all(),[
    'id' => 'required|string',
    'img' => 'required|string|unique:person_count,Person_Type|image64:jpeg,jpg,png|img_min_size:1000,500'
  ]);
  if($Validator->errors()->messages() != null){
    return[
    'messages' => $Validator->errors()->messages()
    ];
  }

  $imageData = $request->get('img');
  $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
  \Image::make($imageData)->resize(1366, 769)->save(public_path('about/').$fileName);


\App\log::insert([
'official_ID' => $request->id,
'table_log' => "ข้อมูล" . $request->count. "",
'project_log' => $id,
'Log_Event' => 'แก้ไขข้อมูล',
'Log_IP'  => \Request::ip(),
'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
]);
 $logid =  \App\log::where([
     ['official_ID', '=', $request->id],
     ])->max('Log_ID');

     \App\person::where('Person_ID',$id)
                 ->update([
                   'Log_ID' => $logid,
                   'Person_Num'  => $fileName,
                   'perupdated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                 ]);


}
if ($request->name) {
  $Validator = Validator::make($request->all(),[
    'id' => 'required|string',
    'name' => 'required|string'
  ]);
  if($Validator->errors()->messages() != null){
    return[
    'messages' => $Validator->errors()->messages()
    ];
  }
  \App\log::insert([
    'official_ID' => $request->id,
    'table_log' => "ข้อมูล" . $request->type. "",
    'project_log' => $id,
    'Log_Event' => 'แก้ไขข้อมูล',
    'Log_IP'  => \Request::ip(),
    'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
]);

$logid =  \App\log::where([
['official_ID', '=', $request->id],
])->max('Log_ID');

\App\person::where('Person_ID',$id)
          ->update([
            'Log_ID' => $logid,
            'Person_Num'  => $request->name,
            'perupdated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
          ]);
}
  

     }


     public function delete(Request $request,$id)
     {

       $time =Carbon::now('Asia/Bangkok');
         \App\log::insert([
         'official_ID' => $request->id,
         'table_log' => 'ข้อมูลผู้ต้องขัง',
         'project_log' => $id,
         'Log_Event' => 'ลบข้อมูล',
         'Log_IP'  => \Request::ip(),
         'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
         ]);

     \App\person::where('Person_ID', '=', $id)->delete();

     $info = \App\person::join('log','person_count.Log_ID','=','log.Log_ID')
                 ->join('official', 'official.official_ID', '=', 'log.official_ID')
                 ->select('official.official_Name', 'person_count.Person_Type', 'person_count.Person_Num','person_count.perupdated_at','person_count.Person_ID','official.official_ID')
                 ->get();

     return response()->json($info);



     }

    public function index()
    {

      return view('official.officialperson');

    }



}
