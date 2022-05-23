<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction',function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            // $table->integer('clothes_id')->unsigned();
            // $table->integer('quantity');
            $table->enum('checked_out', [0,1]);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('clothes_id')->references('id')->on('clothes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction');
    }
}

