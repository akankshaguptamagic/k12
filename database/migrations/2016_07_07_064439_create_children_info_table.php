<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sch_id')->unsigned();
			$table->foreign('sch_id')->references('id')->on('schools');
            $table->integer('teacher_room_id')->unsigned();
		    $table->foreign('teacher_room_id')->references('id')->on('teachers_rooms');
            $table->integer('users_id')->unsigned();
			$table->foreign('users_id')->references('id')->on('users');
			$table->integer('grp_id')->unsigned()->nullable();
            $table->foreign('grp_id')->references('id')->on('social_groups');
            $table->string('childs_firstname');
            $table->string('childs_lastname');
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
         Schema::drop('child_info');
    }
}
