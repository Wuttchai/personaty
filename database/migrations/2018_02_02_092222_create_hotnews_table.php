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
            $table->integer('Log_ID')->unsigned();
            $table->string('Hotnews_name');
            $table->string('Hotnews_detail');
            $table->string('Hotnews_img');
            $table->string('datefirst');
            $table->string('datelast');

            $table->string('hotcreated_at');
            $table->string('hotupdated_at');

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
