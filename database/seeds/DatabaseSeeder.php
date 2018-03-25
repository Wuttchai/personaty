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


                      App\User::create([


                                        'User_Name' => 'เจ้าหน้าที่',
                                        'email' => 'admin@admin.com',
                                        'User_Address' => '-',
                                        'User_Tel' => '01111111111',
                                        'password' => bcrypt('123456'),

                                      ]);

    }
}
