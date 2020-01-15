<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable();
            $table->string('matric_no')->unique();
            $table->string('first_name');
            $table->string('other_name')->nullable();
            $table->string('surname');
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('religion')->nullable();
            $table->string('homeaddress')->nullable();
            $table->string('photo')->default('profile.png')->nullable();
            $table->char('gender');
            $table->string('DOB');
            $table->boolean('Is_Active')->default(1);
//            $table->integer('classroom_id')->unsigned();
//            $table->foreign('classroom_id')->references('id')->on('classroom');
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
        Schema::dropIfExists('students');
    }
}
