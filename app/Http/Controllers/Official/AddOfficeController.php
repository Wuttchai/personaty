<?php

namespace App\Http\Controllers\Official;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Khill\Lavacharts\Lavacharts;

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

public function graphproduct() {

  $acs = \App\doccument:: select("doc_id")
    ->where('doc_datecre','>',Carbon::now()->startOfMonth())
    ->count();

      $doccument = \App\doccument::count();
      $info = \App\info::count();
      $person_count = \App\person::count();
      $product = \App\product::count();
      $calender = \App\calender::count();
      $Hotnews_type1 = \App\hotnews:: select("Hotnews_type")->where('Hotnews_type','ข่าวประชาสัมพันธ์')->count();
      $Hotnews_type2 = \App\hotnews:: select("Hotnews_type")->where('Hotnews_type','ข่าวกิจกรรม')->count();


      $chartjs = app()->chartjs
           ->name('barChartTest')
           ->type('doughnut')
           ->size(['width' => 200  , 'height' => 100])
           ->labels(['เอกสารที่เผยแพร่','ภาพแบรน์เนอร์','จำนวนผู้ต้องขัง','สินค้าวิชาชีพ','ข่าวประชาสัมพันธ์','ข่าวกิจกรรม','ข้อมูลวันหยุด'])

         ->datasets([
             [
                 'backgroundColor' => ['#FF6384', '#36A2EB','#147a00','#efff00','#1d3461','#463359','#cc6600'],
                 'hoverBackgroundColor' => ['#FF6384', '#36A2EB','#147a00','#efff00','#1d3461','#463359','#cc6600'],
                 'data' => [$doccument, $info, $person_count, $product, $Hotnews_type1, $Hotnews_type2, $calender]
             ]
         ])
         ->options([]);



     return view('official.loggraph', compact('chartjs'));
 }
public function graph() {
//now
  $acs = \App\doccument:: select("doc_id")
    ->where('doc_datecre','>',Carbon::now()->startOfMonth())
    ->count();
//
      $doccument = \App\doccument::count();
      $info = \App\info::count();
      $person_count = \App\person::count();
      $product = \App\product::count();
      $calender = \App\calender::count();
      $Hotnews_type1 = \App\hotnews:: select("Hotnews_type")->where('Hotnews_type','ข่าวประชาสัมพันธ์')->count();
      $Hotnews_type2 = \App\hotnews:: select("Hotnews_type")->where('Hotnews_type','ข่าวกิจกรรม')->count();


      $chartjs = app()->chartjs
           ->name('barChartTest')
           ->type('doughnut')
           ->size(['width' => 200  , 'height' => 100])
           ->labels(['เอกสารที่เผยแพร่','ภาพแบรน์เนอร์','จำนวนผู้ต้องขัง','สินค้าวิชาชีพ','ข่าวประชาสัมพันธ์','ข่าวกิจกรรม','ข้อมูลวันหยุด'])

         ->datasets([
             [
                 'backgroundColor' => ['#FF6384', '#36A2EB','#147a00','#efff00','#1d3461','#463359','#cc6600'],
                 'hoverBackgroundColor' => ['#FF6384', '#36A2EB','#147a00','#efff00','#1d3461','#463359','#cc6600'],
                 'data' => [$doccument, $info, $person_count, $product, $Hotnews_type1, $Hotnews_type2, $calender]
             ]
         ])
         ->options([]);



     return view('official.loggraph', compact('chartjs'));
 }
     public function readItems() {
       $info = \App\official::select('official_ID', 'official_Name', 'info','product','hotnews','activity','prison','document','calender')
                    ->orderBy('offupdated_at', 'desc')
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

                    if (!$request->info && !$request->product && !$request->hotnews && !$request->activity && !$request->prison && !$request->documentper && !$request->calender) {

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
                  }if ($request->documentper) {
                 $request->documentper = 'จัดการ';
               }else {
                 $request->documentper = '-';
               }if ($request->calender) {
              $request->calender = 'จัดการ';
            }else {
              $request->calender = '-';
            }


             $time =Carbon::now('Asia/Bangkok');

                   \App\official::insert([

                                 'official_Name' => $request->name,
                                 'official_Email'  => $request->email,
                                 'official_Role' => 'user',
                                 'official_cotton' =>'-',
                                 'info'  => $request->info,
                                 'product'  =>  $request->product,
                                 'hotnews'  => $request->hotnews,
                                 'activity'  => $request->activity,
                                 'prison'  => $request->prison,
                                 'document'  => $request->documentper,
                                 'calender'  => $request->calender,
                                 'official_Password' =>$request->password,
                                 'offcreated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "" ,
                                 'offupdated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                               ]);




                  }


     }

public function showedit($id)
{
  $official = \App\official::select('official_ID', 'official_Name','official_Password','official_Email', 'info','product','hotnews','activity','prison','document','calender')
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


                      if (!$request->info && !$request->product && !$request->hotnews && !$request->activity && !$request->prison && !$request->calender && !$request->documentper) {

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
                    }if ($request->documentper) {
                   $request->documentper = 'จัดการ';
                 }else {
                   $request->documentper = '-';
                 }if ($request->calender) {
                $request->calender = 'จัดการ';
              }else {
                $request->calender = '-';
              }



                    $time =Carbon::now('Asia/Bangkok');





                              \App\official::where('official_ID',$id)
                                          ->update([

                                            'official_Name' => $request->name,
                                            'official_Email'  => $request->email,
                                            'official_cotton' =>'-',
                                            'official_Role' => 'user',
                                            'info'  => $request->info,
                                            'product'  =>  $request->product,
                                            'hotnews'  => $request->hotnews,
                                            'activity'  => $request->activity,
                                            'prison'  => $request->prison,
                                            'document'  => $request->documentper,
                                            'calender'  => $request->calender,
                                            'official_Password' =>$request->password,
                                            'offcreated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "" ,
                                            'offupdated_at' =>"" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . ""
                                          ]);





                    }


}
public function logfile()
{

  if (Session::get('idoffice') == '1') {
    $logfile = \App\log::join('official', 'official.official_ID', '=', 'log.official_ID')
                ->select('official.official_Name', 'log.table_log', 'log.project_log', 'log.Log_Event','log.Log_IP','log.Log_Time')

                ->orderBy('Log_Time', 'desc')
                ->get();
}
  $logfile = \App\log::join('official', 'official.official_ID', '=', 'log.official_ID')
              ->select('official.official_Name', 'log.table_log', 'log.project_log', 'log.Log_Event','log.Log_IP','log.Log_Time')
            
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
