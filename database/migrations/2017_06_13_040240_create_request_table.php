<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Request', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transId',64);
            $table->string('partnerCode',64);
            $table->string('refName',64);
            $table->string('func',64);
            $table->string('telco',7);
            $table->integer('cardPrice');
            $table->integer('cardQuanlity');
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
        Schema::dropIfExists('Request');
    }
}
