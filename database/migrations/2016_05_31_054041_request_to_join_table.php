<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RequestToJoinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('join_requests', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('email')->unique();
			$table->string('password');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('school');
            $table->string('childs_firstname');
            $table->string('childs_lastname');
            $table->string('relationship_to_child');
            $table->string('classroom');
			$table->string('mobile_no');
            $table->string('note');
			$table->boolean('email_confirmed')->default(0);
            $table->string('email_confirmation_code')->nullable();
			$table->boolean('otp_confirmed')->default(0);
            $table->string('otp_code')->nullable();
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
        Schema::table('join_requests', function (Blueprint $table) {
            //
        });
    }
}
