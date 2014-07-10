<?php

use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    public function up()
    {
        Schema::create('users', function ($table) {
            $table->increments('id')->unsigned();
            $table->string('name', 64);
            $table->string('email', 120)->unique();
            $table->string('password', 60)->null();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    public function down()
    {
        Schema::drop('users');
    }
}
