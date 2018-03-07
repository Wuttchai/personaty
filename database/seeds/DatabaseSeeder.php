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

                        'official_Name' => 'Admin',
                        'official_Email' => 'admin@admin.com',
                        'official_Role' => '0',
                        'official_cotton' => '0',
                        'official_Password' => '123456',
                        'info' => 'จัดการ',
                        'product' => 'จัดการ',
                        'hotnews' => 'จัดการ',
                        'activity' => 'จัดการ',
                        'prison' => 'จัดการ',
                        'offcreated_at' => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
                        'offupdated_at' => "" . $time->year. "-" . $time->month . "-" . $time->day . " " . $time->hour . ":" . $time->minute. ":" . $time->second . "",
                      ]);
    }
}
