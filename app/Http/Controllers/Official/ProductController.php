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
       $info = \App\hotnews::join('log','hotnews.Log_ID','=','log.Log_ID')
                   ->join('official', 'official.official_ID', '=', 'log.official_ID')
                   ->select('official.official_Name', 'hotnews.Hotnews_Name', 'hotnews.hotupdated_at','hotnews.Hotnews_img','hotnews.datelast','hotnews.Hotnews_ID')
                   ->get();


     		return response()->json($info);
     	}


     public function insert(Request $request)
     {


    $validator =  Validator::make($request->all(), [
         'id' => 'required|string',
         'name' => 'required|string',
        'fileoffice' => 'required|image64:jpeg,jpg,png',
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
                 $test1 = '';
                 $test2 = '';
                 $test3 = '';
                 $test4 = '';

                 foreach ($request->type as $key => $someVar) {

                      if ($someVar == 'เบเกอรี่') {
                        $test1 = 'เบเกอรี่';
                      }
                      if ($someVar == 'เฟอนิเจอร์') {
                        $test2 = 'เฟอนิเจอร์';
                      }
                      if ($someVar == 'อุปกรณ์') {
                        $test3 = 'อุปกรณ์';
                      }
                      if ($someVar == 'เทคโนโลยี') {
                        $test4 = 'เทคโนโลยี';
                      }
                 }
                $type =  $test1 . "," . $test2 . "," .$test3. "," .$test4 ;


                 $request->detail= str_replace("\n", "", "$request->detail");



                 $imageData = $request->get('fileoffice');
       $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
     \Image::make($imageData)->save(public_path('hotnew/').$fileName);


$time =Carbon::now('Asia/Bangkok');
    \App\log::insert([
      'official_ID' => $request->id,
      'table_log' => 'product',
      'project_log' => '0',
      'Log_Event' => 'เพิ่ม',
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
                              'Pro_Type' => $type,
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

       $infoedit = \App\hotnews::join('log','hotnews.Log_ID','=','log.Log_ID')
                   ->join('official', 'official.official_ID', '=', 'log.official_ID')
                   ->select('official.official_ID', 'hotnews.Hotnews_Name','hotnews.Hotnews_img','hotnews.Hotnews_detail','hotnews.Hotnews_ID','hotnews.datelast','hotnews.datefirst')
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
   'detail' => 'required|string',
   'datefirst' => 'required|string',
   'datelast' => 'required|string',
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
                  'table_log' => 'info',
                  'project_log' => $id,
                  'Log_Event' => 'แก้ไข',
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
                          'datefirst' => $request->datefirst,
                          'datelast' => $request->datelast,
                          'hotcreated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "" ,
                          'hotupdated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                        ]);






//------


}else {
  $Validator = Validator::make($request->all(),[
    'id' => 'required|string',
    'name' => 'required|string',
   'detail' => 'required|string',
   'datefirst' => 'required|string',
   'datelast' => 'required|string',
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
                  'table_log' => 'hotnews',
                  'project_log' => $id,
                  'Log_Event' => 'แก้ไข',
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
                          'hotcreated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "" ,
                          'hotupdated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                        ]);


}



     }


     public function delete(Request $request,$id)
     {

       $time =Carbon::now('Asia/Bangkok');
         \App\log::insert([
         'official_ID' => $request->id,
         'table_log' => 'hotnews',
         'project_log' => $id,
         'Log_Event' => 'ลบ',
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

      return view('official.officialproduct');

    }



}
