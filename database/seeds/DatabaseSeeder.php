<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
      $time =Carbon::now('Asia/Bangkok');
  


                      App\official::create([

                                        'official_ID' => '6',
                                        'table_log' => 'official',
                                        'project_log' => '0',
                                        'Log_Event' => 'เข้าสู่ระบบ',
                                        'Log_IP' => '10.81.225.141',
                                        'Log_Time' => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
                                      ]);
    }
}
