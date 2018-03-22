<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoccumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doccument', function (Blueprint $table) {
          $table->increments('doc_id');
          $table->integer('Log_ID')->unsigned();
          $table->string('doc_name');
          $table->string('doc_file');
          $table->string('doc_datecre');
          $table->string('doc_dateup');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doccument');
    }
}
