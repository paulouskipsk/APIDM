<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->timestamps = false;
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('login', 100);
            $table->string('password', 100);
            $table->text('image');
            $table->char('status', 1);
            $table->string('api_token', 80)
                    ->after('password')
                    ->unique()
                    ->nullable()
                    ->default(null);
            
        });
/*
        DB::insert(
            "insert into users(id, name, login, password, status, image) values
            (1, 'Usuario 1', 'usuario1', '123', 'A', ''),
            (2, 'Usuario 2', 'usuario2', '1234', 'A', ''),
            (3, 'Usuario 3', 'usuario3', '12345', 'A', '')"
        );*/
    }

    public function down()
    {
        Schema::drop('users');
    }
}
