<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarbequeUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barbeque_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('barbeque_id')->unsigned();
            $table->dateTime('rent_date');
            $table->dateTime('return_date')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('barbeque_id')->references('id')->on('barbeques');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barbeque_user');
    }
}
