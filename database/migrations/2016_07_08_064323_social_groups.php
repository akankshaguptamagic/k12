<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SocialGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_groups', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('sch_id')->unsigned();
            $table->foreign('sch_id')->references('id')->on('schools');
			$table->string('group_name');
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
       Schema::drop('social_groups');
    }
}
