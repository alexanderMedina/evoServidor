<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDog extends Migration
{

    public function up()
    {
        Schema::create('dogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('breed', 100);
            $table->integer('age');
            $table->boolean('gender');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });

    }


    public function down()
    {
        Schema::drop('dogs');
    }
}
