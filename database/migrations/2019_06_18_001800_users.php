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
        });

        DB::beginTransaction();
                DB::table('users')->insert([
                    'name'      => 'Administrator', 
                    'login'     => 'adm',
                    'password'  => Hash::make('adm'),
                    'image'     => $this->getImageAdm(),              
                ]);
            DB::commit();
    }

    public function down()
    {
        Schema::drop('users');
    }

    private function getImageAdm(){
        return "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";

    }
}
