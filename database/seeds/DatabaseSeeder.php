<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\official::create([

                        'official_Name' => 'Admin',
                        'official_Email' => 'admin@admin.com',
                        'official_Role' => '0',
                        'Log_ID'=>'00',
                        'official_Password' => '123456',

                      ]);
    }
}
