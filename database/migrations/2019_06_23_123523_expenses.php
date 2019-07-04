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
            $table->char('status',1);
            $table->date('paymentDate');
            $table->double('amountPay' );
            $table->double('additionalCharges')
                    ->nullable()
                    ->default(0);
            $table->char('paid', 1)
                    ->default(0);
            $table->string('comments')
                    ->nullable();
            $table->bigInteger('category_id');      
            $table->timestamps = false;
        });
    }

    public function down()
    {
        Schema::drop('expenses');
    }
}
