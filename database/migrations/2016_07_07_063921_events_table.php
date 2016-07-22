<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('school_id')->unsigned();
            $table->foreign('school_id')->references('id')->on('schools');
            $table->string('title');
			$table->string('description');
			$table->string('start');
			$table->string('backgroundColor');
			$table->string('borderColor');
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
        Schema::drop('events');
    }
}
