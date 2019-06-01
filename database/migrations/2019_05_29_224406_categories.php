<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Categories extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description', 100);
            $table->char('status');
            $table->timestamps();
            $table->softDeletes();  
        });
    }

    public function down()
    {
        Schema::drop('categories');
    }
}
