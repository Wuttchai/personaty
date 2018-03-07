<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotnewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotnews', function (Blueprint $table) {
            $table->increments('Hotnews_ID');
            $table->integer('Log_ID');
            $table->string('Hotnews_name');
            $table->string('Hotnews_detail');
            $table->string('Hotnews_img');
            $table->string('datefirst');
            $table->string('datelast');
            $table->string('datefirst');
            $table->dateTime('hotcreated_at');
            $table->dateTime('hotupdated_at');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotnews');
    }
}
