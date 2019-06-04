<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Types extends Migration
{
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description', 100);
            $table->char('status');
            $table->timestamps = false;
        });

        DB::insert(
            "insert into types (description, status) 
            values ('Receitas','A'), ('Despesas','A')"
        );
    }

    public function down()
    {
        Schema::drop('types');
    }
}
