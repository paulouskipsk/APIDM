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
            $table->char('status', 1);
            $table->integer('type_id');
            $table->timestamps = false;
        });

        DB::insert(
            "insert into categories(id, description, status, type_id) values
            (1, 'Receita Fixa', 'A', 1),(2, 'Premiação 2', 'A', 1),
            (3, 'Despesa Fixa', 'A', 2),(4, 'Cartão de Credito', 'A', 2)"
        );
    }

    public function down()
    {
        Schema::drop('categories');
    }
}
