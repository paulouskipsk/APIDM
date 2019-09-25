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
            $table->double('receivingValue');
            $table->date('receivingDate' );
            $table->char('received', 1)
                        ->nullable()
                        ->default(0);        
            $table->timestamps = false;
        });
    }

    public function down()
    {
        Schema::drop('revenues');
    }
}
