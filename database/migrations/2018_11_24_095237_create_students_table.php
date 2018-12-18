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
            $table->string('matric_no', 12);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('photo')->default('profile.png');
            //class_section like jss 1a
            //the class is jss 1 the section is "a"

            //from parents table

            $table->char('gender');
            $table->string('DOB');

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
