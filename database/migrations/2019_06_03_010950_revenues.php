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
            $table->char('status',1);
            $table->double('receivingValue');
            $table->date('receivingDate' );
            $table->char('received', 1)
                        ->nullable()
                        ->default(0);    
            $table->string('comments')
                        ->nullable()
                        ->default(null);    
            $table->bigInteger('category_id');      
            $table->timestamps = false;
        });
    }

    public function down()
    {
        Schema::drop('revenues');
    }
}
