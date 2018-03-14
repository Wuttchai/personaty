<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_detail', function (Blueprint $table) {
            $table->increments('Det_ID');
            $table->integer('Prosell_ID')->unsigned();
            $table->integer('Pro_ID')->unsigned();
            $table->integer('Det_Num');
            $table->integer('Det_total');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('department');
    }
}
