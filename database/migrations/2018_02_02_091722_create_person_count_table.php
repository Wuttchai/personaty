<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonCountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_count', function (Blueprint $table) {
            $table->increments('Person_ID');
            $table->integer('Log_ID')->unsigned();
            $table->integer('Person_Num');
            $table->string('Person_Type');
            $table->dateTime('percreated_at');
            $table->dateTime('perupdated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person_count');
    }
}
