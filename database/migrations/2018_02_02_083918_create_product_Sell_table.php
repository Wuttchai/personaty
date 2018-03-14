<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSellTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_Sell', function (Blueprint $table) {
            $table->increments('Prosell_ID');
            $table->integer('User_ID')->unsigned();
            $table->integer('Prosell_Quantity');
            $table->integer('Prosell_totalPirce');
            $table->string('Prosell_send');
            $table->string('Prosell_img');
            $table->string('Prosell_creat');
            $table->string('Prosell_orderdate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_Sell');
    }
}
