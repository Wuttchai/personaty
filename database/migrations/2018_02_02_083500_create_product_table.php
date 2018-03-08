<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {



            $table->increments('Pro_ID');
            $table->integer('Log_ID')->unsigned();
            $table->string('Pro_Name');
            $table->integer('Pro_Price');
            $table->string('Pro_Detail');
            $table->string('Pro_Type');
            $table->string('Pro_img');
            $table->integer('Pro_Count');
            $table->dateTime('procreated_at');
            $table->dateTime('proupdated_at');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
