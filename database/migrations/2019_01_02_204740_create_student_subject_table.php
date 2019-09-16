<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_subject', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('settings_id');
            $table->unique(['session_id','term_id','student_id','subject_id','classroom_id']);
            $table->integer('session_id')->unsigned();
            $table->integer('term_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->string('student_name')-nullable();
            $table->integer('subject_id')->unsigned();
            $table->integer('classroom_id');
            $table->string('classroom_name')->nullable();
            $table->integer('section_id');
            $table->string('section_name')->nullable();
            $table->integer('testone')->nullable()->default('0');
            $table->integer('testtwo')->nullable()->default('0');;
            $table->integer('testthree')->nullable()->default('0');
            $table->integer('exam')->nullable();
            $table->boolean('edit')->default(false);
            $table->foreign('session_id')->references('id')->on('session')->onDelete('cascade');
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
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
        Schema::dropIfExists('student_subject');
    }
}
