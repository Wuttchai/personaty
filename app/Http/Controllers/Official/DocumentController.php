<?php

namespace App\Http\Controllers\Official;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Intervention\Image\ImageManager ;
use Illuminate\Support\Facades\Storage;
use File;

class DocumentController extends Controller
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
       $xxx = \App\doccument::join('log','doccument.Log_ID','=','log.Log_ID')
                   ->join('official', 'official.official_ID', '=', 'log.official_ID')
                   ->select('official.official_Name', 'doccument.doc_name', 'doccument.doc_dateup','doccument.doc_file','doccument.doc_status','doccument.doc_id')
                   ->orderBy('doccument.doc_dateup', 'desc')
                   ->get();


     		return response()->json($xxx);
     	}

 public function showpdf($id)
{

  $file = \App\doccument::select('doccument.doc_file')
              ->where('doc_id','=',$id)
              ->get();

              return view('official.pdf',[

                'file' => $file
              ]);

}

     public function insert(Request $request)
     {


       $request->name= str_replace("\n", "", "$request->name");



    $validator =  Validator::make($request->all(), [
         'id' => 'required|string',
         'name' => 'required|regex:/^([a-zA-Z0-9ก-ูเ-๋๑-๙])/',
        'fileoffice' => 'required|mimes:pdf|max:1000',

           ]);

           if($validator->fails()){

                 return[
                 'messages' => $validator->errors()->messages()
                 ];
               }

               else {

                 $string = strip_tags($request->fileoffice->getClientOriginalName());

                 if (strlen($string) >= 40) {
                 $info = ['',''];
                 $info[0] ='true';
                 $info[1] ='ชื่อไฟล์มีขนาดยาวเกินไป';
                   return response()->json($info);

                 }

$time =Carbon::now('Asia/Bangkok');


 $imageName =   $time->day. '-' .$request->id . '.' .  $request->fileoffice->getClientOriginalName();

          $request->fileoffice->move(
                    base_path() . '/public/pdf/', $imageName
                );


$time =Carbon::now('Asia/Bangkok');
    \App\log::insert([
      'official_ID' => $request->id,
      'table_log' => 'ข้อมูลเอกสารที่เผยแพร่',
      'project_log' => '0',
      'Log_Event' => 'เพิ่มข้อมูล',
      'Log_IP'  => \Request::ip(),
      'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
]);

                $logid =  \App\log::where([
                    ['official_ID', '=', $request->id],
                    ])->max('Log_ID');



                \App\doccument::insert([
                              'Log_ID' => $logid,
                              'doc_name' => $request->name,
                              'doc_file'  => $imageName,
                              'doc_status'  => '-',
                              'doc_datecre' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "" ,
                              'doc_dateup' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                            ]);
                $projectlog =  \App\doccument::where([
                                ['Log_ID', '=', $logid],
                                ])->max('doccument.doc_id');

                \App\log::where('Log_ID',$logid)
                                      ->update([
                                      'project_log' => $projectlog,


                                  ]);




               }





     }
     public function showedit($id) {


                   $xxx = \App\doccument::join('log','doccument.Log_ID','=','log.Log_ID')
                               ->join('official', 'official.official_ID', '=', 'log.official_ID')
                               ->select('official.official_ID', 'doccument.doc_name', 'doccument.doc_dateup','doccument.doc_file','doccument.doc_id')
                               ->where('doccument.doc_id','=' ,$id)
                               ->get();


        return response()->json($xxx);
      }

     public function update(Request $request,$id)
     {
if ($request->fileoffice) {


$request->name= str_replace("\n", "", "$request->name");
$time =Carbon::now('Asia/Bangkok');

  $Validator = Validator::make($request->all(),[
    'id' => 'required|string',
    'name' => 'required|regex:/^([a-zA-Z0-9ก-ูเ-๋๑-๙])/',
   'fileoffice' => 'required|mimes:pdf|max:1000',
  ]);
  if($Validator->errors()->messages() != null){
    return[
    'messages' => $Validator->errors()->messages()
    ];
  }
  $string = strip_tags($request->fileoffice->getClientOriginalName());

  if (strlen($string) >= 40) {
  $info = ['',''];
  $info[0] ='true';
  $info[1] ='ชื่อไฟล์มีขนาดยาวเกินไป';
    return response()->json($info);

  }

   $imageName =   $time->day. '-' .$request->id . '.' .  $request->fileoffice->getClientOriginalName();
   $imagedel = \App\doccument::select('doc_file')
               ->where('doc_id','=',$id)
               ->get();

   $image_path = "pdf/".$imagedel[0]->doc_file."";



            $request->fileoffice->move(
                      base_path() . '/public/pdf/', $imageName
                  );

                \App\log::insert([
                  'official_ID' => $request->id,
                  'table_log' => 'ข้อมูลเอกสารที่เผยแพร่',
                  'project_log' => $id,
                  'Log_Event' => 'แก้ไขข้อมูล',
                  'Log_IP'  => \Request::ip(),
                  'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
            ]);

        $logid =  \App\log::where([
            ['official_ID', '=', $request->id],
            ])->max('Log_ID');

            \App\doccument::where('doc_id',$id)
                        ->update([
                          'Log_ID' => $logid,
                          'doc_name' => $request->name,
                          'doc_file'  => $imageName,
                          'doc_status'  => '-',
                          'doc_dateup' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                        ]);
}else {


$request->name= str_replace("\n", "", "$request->name");
$time =Carbon::now('Asia/Bangkok');

  $Validator = Validator::make($request->all(),[
    'id' => 'required|string',
    'name' => 'required|regex:/^([a-zA-Z0-9ก-ูเ-๋๑-๙])/',
  ]);
  if($Validator->errors()->messages() != null){
    return[
    'messages' => $Validator->errors()->messages()
    ];
  }

                \App\log::insert([
                  'official_ID' => $request->id,
                  'table_log' => 'ข้อมูลเอกสารที่เผยแพร่',
                  'project_log' => $id,
                  'Log_Event' => 'แก้ไขข้อมูล',
                  'Log_IP'  => \Request::ip(),
                  'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
            ]);

        $logid =  \App\log::where([
            ['official_ID', '=', $request->id],
            ])->max('Log_ID');

            \App\doccument::where('doc_id',$id)
                        ->update([
                          'Log_ID' => $logid,
                          'doc_name' => $request->name,
                          'doc_dateup' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                        ]);
}

     }


     public function delete(Request $request,$id)
     {

       $time =Carbon::now('Asia/Bangkok');
         \App\log::insert([
         'official_ID' => $request->id,
         'table_log' => 'ข้อมูลเอกสารที่เผยแพร่',
         'project_log' => $id,
         'Log_Event' => 'ลบข้อมูล',
         'Log_IP'  => \Request::ip(),
         'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
         ]);
         $imagedel = \App\doccument::select('doc_file')
                     ->where('doc_id','=',$id)
                     ->get();

         $image_path = "pdf/".$imagedel[0]->doc_file."";

     \App\doccument::where('doc_id', '=', $id)->delete();

     $xxx = \App\doccument::join('log','doccument.Log_ID','=','log.Log_ID')
                 ->join('official', 'official.official_ID', '=', 'log.official_ID')
                 ->select('official.official_Name', 'doccument.doc_name', 'doccument.doc_dateup','doccument.doc_file','doccument.doc_status','doccument.doc_id')
                 ->get();


      return response()->json($xxx);



     }


    public function updatestatus(Request $request,$id)
    {

       $time =Carbon::now('Asia/Bangkok');

      \App\log::insert([
        'official_ID' => $request->id,
        'table_log' => 'ข้อมูลเอกสารที่เผยแพร่',
        'project_log' => $id,
        'Log_Event' => 'แก้ไขสถานะการโชว์',
        'Log_IP'  => \Request::ip(),
        'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
  ]);

$logid =  \App\log::where([
  ['official_ID', '=', $request->id],
  ])->max('Log_ID');

  \App\doccument::where('doc_id',$id)
              ->update([
                'Log_ID' => $logid,
                'doc_status' => $request->status,
              ]);

              $xxx = \App\doccument::join('log','doccument.Log_ID','=','log.Log_ID')
                          ->join('official', 'official.official_ID', '=', 'log.official_ID')
                          ->select('official.official_Name', 'doccument.doc_name', 'doccument.doc_dateup','doccument.doc_file','doccument.doc_status','doccument.doc_id')
                          ->get();


               return response()->json($xxx);

    }
    public function index()
    {

      return view('official.document');

    }


}
