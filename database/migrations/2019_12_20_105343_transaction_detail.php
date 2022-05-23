<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransactionDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_detail',function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('clothes_id')->unsigned();
            $table->integer('quantity');
            // $table->integer('subTotal');
            // $table->integer('grandTotal');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('clothes_id')->references('id')->on('clothes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
