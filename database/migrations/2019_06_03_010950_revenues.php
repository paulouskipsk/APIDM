<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Revenues extends Migration
{
    public function up()
    {
        Schema::create('revenues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description', 100);
            $table->char('status');
            $table->timestamps = false;
        });
    }

    public function down()
    {
        Schema::drop('revenues');
    }
}
