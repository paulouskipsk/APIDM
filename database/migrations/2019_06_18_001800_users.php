<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

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
            $table->char('tutorial_ok', 1)
                    ->nullable()
                    ->default('F');
            $table->string('api_token', 80)
                    ->after('password')
                    ->unique()
                    ->nullable()
                    ->default(null);
            
        });

        DB::beginTransaction();
                DB::table('users')->insert([
                    'name'      => 'Administrator', 
                    'login'     => 'adm',
                    'password'  => Hash::make('adm'),
                    'status'    => 'A',
                    'image'     => 'nada',   
                    'api_token' => Str::random(60)            
                ]);
            DB::commit();
    }

    public function down()
    {
        Schema::drop('users');
    }
}
