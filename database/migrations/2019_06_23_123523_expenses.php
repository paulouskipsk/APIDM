<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Expenses extends Migration
{
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description', 100);
            $table->date('paymentDate');
            $table->double('amountPay' );
            $table->char('paid', 1)
                    ->default(0);
            $table->timestamps = false;
        });
    }

    public function down()
    {
        Schema::drop('expenses');
    }
}

//insert into expenses(id, description, paymentDate, amountPay, paid) values(0, "descricao", "paymentDate", "amountPay", 1)