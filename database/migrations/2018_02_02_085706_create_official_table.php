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
          $table->string('official_Name')->unique();
          $table->string('official_Email')->unique();
          $table->string('official_Role');
          $table->string('official_cotton');
          $table->string('official_Password');
          $table->string('info');
          $table->string('product');
          $table->string('hotnews');
          $table->string('activity');
          $table->string('prison');
          $table->string('offcreated_at');
          $table->string('offupdated_at');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('official');
    }
}
