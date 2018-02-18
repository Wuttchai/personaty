<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateofficialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('official', function (Blueprint $table) {
          $table->increments('official_ID');
          $table->string('official_Name');
          $table->string('official_Email')->unique();
          $table->string('official_Role');
          $table->string('official_cotton');
          $table->string('official_Password');
          $table->rememberToken();
          $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_sell');
    }
}
