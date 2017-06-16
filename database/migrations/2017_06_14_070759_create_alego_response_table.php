<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlegoResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alego_response', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transId',16);
            $table->string('resCode',2);
            $table->string('resDes',255);
            $table->text('reqData');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alego_response');
    }
}
