<?php

use Illuminate\Database\Migrations\Migration;
use \Illuminate\Database\Schema\Blueprint;

class Raffles extends Migration
{
    public function up()
    {
        Schema::create('raffles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->string('slug', 64)->unique();
            $table->longText('description')->null();
            $table->dateTime('limit_date');
            $table->integer('winners')->unsigned();
            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('users');
            $table->softDeletes();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Schema::create('raffles_participants', function ($table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->string('email', 120);
            $table->integer('raffle_id')->unsigned();
            $table->foreign('raffle_id')->references('id')->on('raffles');
            $table->softDeletes();
            $table->timestamps();
            $table->unique(array('raffle_id', 'email'));
            $table->engine = 'InnoDB';
        });

        Schema::create('raffles_winners', function ($table) {
            $table->increments('id');
            $table->integer('raffle_participant_id')->unsigned()->unique();
            $table->foreign('raffle_participant_id')->references('id')->on('raffles_participants');
            $table->integer('raffle_id')->unsigned();
            $table->foreign('raffle_id')->references('id')->on('raffles');
            $table->softDeletes();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    public function down()
    {
        Schema::drop('raffles_winners');
        Schema::drop('raffles_participants');
        Schema::drop('raffles');
    }
}
