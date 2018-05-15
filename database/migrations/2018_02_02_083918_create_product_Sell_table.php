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
            $table->string('address_name');
            $table->string('address_at');
            $table->string('Prosell_img');
            $table->string('Prosell_about');
            $table->string('address_tumbon');
            $table->string('address_aumpor');
            $table->string('address_province');
            $table->string('address_zipcode');
            $table->string('address_tel')            
            $table->string('Prosell_creat');
            $table->string('Prosell_orderdate');
            $table->string('Prosell_senddate');

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
