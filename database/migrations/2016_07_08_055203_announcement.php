<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Announcement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('sch_id')->unsigned();
            $table->foreign('sch_id')->references('id')->on('schools');
			$table->integer('teacher_room_id')->unsigned()->nullable();
			$table->foreign('teacher_room_id')->references('id')->on('teachers_rooms');
			$table->integer('grp_id')->unsigned()->nullable();
			$table->foreign('grp_id')->references('id')->on('social_groups');
			$table->string('headline');
			$table->string('description');
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
         Schema::drop('announcements');
    }
}
