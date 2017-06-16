<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Response', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transId',64);
            $table->string('partnerCode',64);
            $table->string('resCode',16);
            $table->string('resMsg',255);
            $table->text('resData');
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
        Schema::dropIfExists('Response');
    }
}
