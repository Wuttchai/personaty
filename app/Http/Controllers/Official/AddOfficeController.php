<?php

namespace App\Http\Controllers\Official;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class AddOfficeController extends Controller
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


     public function readItems() {
       $info = \App\official::select('official_ID', 'official_Name', 'info','product','hotnews','activity','prison')
                   ->get();


        return response()->json($info);
      }


     public function add(Request $request)
     {

$validator =  Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|max:255|unique:official,official_Email',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
              ]);

              if($validator->fails()){

                    return[
                    'messages' => $validator->errors()->messages()
                    ];
                  }else {

                    if (!$request->info && !$request->product && !$request->hotnews && !$request->activity && !$request->prison) {

                      return[
                      'nocheck' => 'yes'
                      ];
                    }

                    if ($request->info) {
                    $request->info = 'จัดการ';
                  }else {
                    $request->info = '-';
                  } if ($request->product) {
                    $request->product = 'จัดการ';
                    }else {
                      $request->product = '-';
                    }
                     if ($request->hotnews) {
                    $request->hotnews = 'จัดการ';
                    }else {
                      $request->hotnews = '-';
                    }  if ($request->activity) {
                    $request->activity = 'จัดการ';
                    }else {
                      $request->activity = '-';
                    }  if ($request->prison) {
                    $request->prison = 'จัดการ';
                  }else {
                    $request->prison = '-';
                  }


             $time =Carbon::now('Asia/Bangkok');
             \App\log::insert([
             'official_ID' => $request->id,
             'table_log' => 'ข้อมูลเจ้าหน้าที่',
             'project_log' => '0',
             'Log_Event' => 'เพิ่มข้อมูล',
             'Log_IP'  => \Request::ip(),
             'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
             ]);

                   $logid =  \App\log::where([
                       ['official_ID', '=', $request->id],
                       ])->max('Log_ID');





                   \App\official::insert([
                                 'Log_ID' => $logid,
                                 'official_Name' => $request->name,
                                 'official_Email'  => $request->email,
                                 'official_Role' => 'user',
                                 'info'  => $request->info,
                                 'product'  =>  $request->product,
                                 'hotnews'  => $request->hotnews,
                                 'activity'  => $request->activity,
                                 'prison'  => $request->prison,
                                 'official_Password' =>$request->password,
                                 'offcreated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "" ,
                                 'offupdated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                               ]);
                   $projectlog =  \App\official::where([
                                   ['Log_ID', '=', $logid],
                                   ])->max('official_ID');

                   \App\log::where('Log_ID',$logid)
                                         ->update([
                                         'project_log' => $projectlog,
                                     ]);




                  }


     }

public function showedit($id)
{
  $official = \App\official::select('official_ID', 'official_Name','official_Password','official_Email', 'info','product','hotnews','activity','prison')
              ->where('official_ID','=' ,$id)
              ->get();

  return response()->json($official);
}

public function delete(Request $request,$id)
{
  $time =Carbon::now('Asia/Bangkok');
  \App\log::insert([
  'official_ID' => $request->id,
  'table_log' => 'ข้อมูลเจ้าหน้าที่',
  'project_log' => $id,
  'Log_Event' => 'ลบข้อมูล',
  'Log_IP'  => \Request::ip(),
  'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
  ]);

\App\official::where('official_ID', '=', $id)->delete();

$info = \App\official::select('official_ID', 'official_Name', 'info','product','hotnews','activity','prison')
            ->get();


return response()->json($info);



}

public function update(Request $request,$id)
{
  $validator =  Validator::make($request->all(), [
              'name' => 'required|string',
              'email' => 'required|string|email|max:255',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
                ]);

                if($validator->fails()){

                      return[
                      'messages' => $validator->errors()->messages()
                      ];
                    }else {

                      if (!$request->info && !$request->product && !$request->hotnews && !$request->activity && !$request->prison) {

                        return[
                        'nocheck' => 'yes'
                        ];
                      }

                      if ($request->info) {
                      $request->info = 'จัดการ';
                    }else {
                      $request->info = '-';
                    } if ($request->product) {
                      $request->product = 'จัดการ';
                      }else {
                        $request->product = '-';
                      }
                       if ($request->hotnews) {
                      $request->hotnews = 'จัดการ';
                      }else {
                        $request->hotnews = '-';
                      }  if ($request->activity) {
                      $request->activity = 'จัดการ';
                      }else {
                        $request->activity = '-';
                      }  if ($request->prison) {
                      $request->prison = 'จัดการ';
                    }else {
                      $request->prison = '-';
                    }


                    $time =Carbon::now('Asia/Bangkok');
                    \App\log::insert([
                    'official_ID' => $request->id,
                    'table_log' => 'ข้อมูลเจ้าหน้าที่',
                    'project_log' => $id,
                    'Log_Event' => 'แก้ไขข้อมูล',
                    'Log_IP'  => \Request::ip(),
                    'Log_Time'  => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
                    ]);

                          $logid =  \App\log::where([
                              ['official_ID', '=', $request->id],
                              ])->max('Log_ID');




                              \App\official::where('official_ID',$id)
                                          ->update([
                                            'Log_ID' => $logid,
                                            'official_Name' => $request->name,
                                            'official_Email'  => $request->email,
                                            'official_Role' => 'user',
                                            'info'  => $request->info,
                                            'product'  =>  $request->product,
                                            'hotnews'  => $request->hotnews,
                                            'activity'  => $request->activity,
                                            'prison'  => $request->prison,
                                            'official_Password' =>$request->password,
                                            'offcreated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "" ,
                                            'offupdated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                                          ]);





                    }


}
public function logfile()
{
  $logfile = \App\log::join('official', 'official.official_ID', '=', 'log.official_ID')
              ->select('official.official_Name', 'log.table_log', 'log.project_log', 'log.Log_Event','log.Log_IP','log.Log_Time')
              ->where('log.Log_Event', '!=', 'เข้าสู่ระบบ')
              ->where('official.official_ID', '=', Session::get('idoffice'))
              ->orderBy('Log_Time', 'desc')
              ->get();



  return view('official.logfile', ['logfile' => $logfile]);

}
    public function index()
    {
      return view('official.officialadd');

    }
}
