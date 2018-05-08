<?php

namespace App\Http\Controllers\Official;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Intervention\Image\ImageManager ;
use DateTime;

class CalenderController extends Controller
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

public function update(Request $request, $id)
{


  $validator =  Validator::make($request->all(), [
       'nameedit' => 'required|regex:/^([a-zA-Z0-9ก-ูเ-๋๑-๙])/',
       'datefirstedit' => 'required',
       'datelastedit' => 'required',
         ])->validate();
         if ($request->datefirstedit != $request->datefirstedit2) {
           $cutdate = explode("/", $request->datefirstedit);
           $request->datefirstedit = "" . $cutdate[2]-543 . "-" . $cutdate[1] . "-" . $cutdate[0] . "";
         }
         if ($request->datelastedit != $request->datelastedit2) {
           $cutdate1 = explode("/", $request->datelastedit);
           $request->datelastedit = "" . $cutdate1[2]-543 . "-" . $cutdate1[1] . "-" . $cutdate1[0] . "";

         }

          $time =Carbon::now('Asia/Bangkok');
              \App\log::insert([
                'official_ID' => Session::get('idoffice'),
                'table_log' => 'ข้อมูลวันที่เข้าเยี่ยม',
                'project_log' => $id,
                'Log_Event' => 'แก้ไขข้อมูล',
                'Log_IP'  => \Request::ip(),
                'Log_Time'  => "" . $time->day. "-" . $time->month . "-" . $time->year . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
          ]);

      $logid =  \App\log::where([
          ['official_ID', '=', Session::get('idoffice')],
          ])->max('Log_ID');




          \App\calender::where('cal_id',$id)
                      ->update([
                        'Log_ID' => $logid,
                        'cal_name' => $request->nameedit,
                        'cal_date'  => $request->datefirstedit,
                        'cal_last' =>$request->datelastedit
                      ]);

      return redirect()->route('showcalender')->with('alert', 'แก้ไขข้อมูลเรียบร้อย!');
}

 public function showedit($id)
{

  $info = \App\calender::select('cal_name', 'cal_last','cal_date','cal_id')
              ->where('cal_id','=' ,$id)
              ->get();
              $tasks  = \App\calender::select('cal_date','cal_last','cal_name','cal_id')
                          ->get();

Session::put("modalshow","active");
                          return view('official.calender',[
                            'info' => $info

                          ], compact('tasks'));

}

     public function insert(Request $request)
     {
       Session::forget('modalshow');



  $validator =  Validator::make($request->all(), [
       'name' => 'required|regex:/^([a-zA-Z0-9ก-ูเ-๋๑-๙])/',
       'datefirst' => 'required',
       'datelast' => 'required',
         ])->validate();


         $cutdate = explode("/", $request->datefirst);
         $datatime = "" . $cutdate[2]-543 . "-" . $cutdate[1] . "-" . $cutdate[0] . "";

         $cutdate1 = explode("/", $request->datelast);
         $datatime1 = "" . $cutdate1[2]-543 . "-" . $cutdate1[1] . "-" . $cutdate1[0] . "";

               $time =Carbon::now('Asia/Bangkok');
                   \App\log::insert([
                     'official_ID' => Session::get('idoffice'),
                     'table_log' => 'ข้อมูลวันที่เข้าเยี่ยม',
                     'project_log' => '0',
                     'Log_Event' => 'เพิ่มข้อมูล',
                     'Log_IP'  => \Request::ip(),
                     'Log_Time'  => "" . $time->day. "-" . $time->month . "-" . $time->year . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
               ]);

    $logid =  \App\log::where([
        ['official_ID', '=', Session::get('idoffice')],
        ])->max('Log_ID');


        \App\calender::insert([
                     'Log_ID' => $logid,
                     'cal_name' => $request->name,
                     'cal_date'  => $datatime,
                     'cal_last' =>$datatime1
                   ]);
        $projectlog =  \App\calender::where([
                        ['Log_ID', '=', $logid],
                       ])->max('cal_id');

       \App\log::where('Log_ID',$logid)
                             ->update([
                             'project_log' => $projectlog,

                          ]);
  return redirect()->route('showcalender')->with('alert', 'บันทึกข้อมูลเรียบร้อย!');

     }

    public function index()
    {
       Session::forget('modalshow');
      $tasks  = \App\calender::select('cal_date','cal_last','cal_name','cal_id')
                  ->get();
      return view('official.calender', compact('tasks'),['info'=>'','status'=>'' ]);

    }
    public function delete($id)
    {

      $time =Carbon::now('Asia/Bangkok');
        \App\log::insert([
        'official_ID' => Session::get('idoffice'),
        'table_log' => 'ข้อมูลผู้ต้องขัง',
        'project_log' => $id,
        'Log_Event' => 'ลบข้อมูล',
        'Log_IP'  => \Request::ip(),
        'Log_Time'  => "" . $time->day. "-" . $time->month . "-" . $time->year . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
        ]);

    \App\calender::where('cal_id', '=', $id)->delete();


      return redirect()->route('showcalender')->with('alert', 'ลบเรียบร้อย!');

    }


}
