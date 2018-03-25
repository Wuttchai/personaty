<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestiondetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questiondetail', function (Blueprint $table) {
          $table->increments('quesde_id');
          $table->integer('User_ID')->unsigned();
          $table->integer('ques_id')->unsigned();
          $table->string('quesde_owner');
          $table->string('quesde_detail');
          $table->string('quesde_date');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questiondetail');
    }
}
