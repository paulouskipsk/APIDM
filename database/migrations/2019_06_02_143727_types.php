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
            $table->char('status', 1);
            $table->timestamps = false;
        });

        DB::insert(
            "insert into types (id, description, status) 
            values (1, 'Receitas','A'), (2, 'Despesas','A')"
        );
    }

    public function down()
    {
        Schema::drop('types');
    }
}
