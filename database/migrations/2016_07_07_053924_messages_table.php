<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
			$table->integer('school_id')->unsigned();
			$table->foreign('school_id')->references('id')->on('schools');
			$table->integer('group_id')->unsigned()->nullable();
			$table->foreign('group_id')->references('id')->on('social_groups');
			$table->integer('class_id')->unsigned()->nullable();
			$table->foreign('class_id')->references('id')->on('teachers_rooms');
			$table->string('message');
			$table->boolean('status');
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
        Schema::drop('messages');
    }
}
