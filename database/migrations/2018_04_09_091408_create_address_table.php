<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('address_id');
            $table->integer('User_ID')->unsigned();
            $table->string('address_name');
            $table->string('address_at');
            $table->string('address_tumbon');
            $table->string('address_aumpor');
            $table->string('address_province');
            $table->string('address_zipcode');
            $table->string('address_tel');
            $table->string('status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
}
