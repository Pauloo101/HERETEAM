<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentSessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_session', function (Blueprint $table) {
            $table->increments('id');
            $table->unique(['session_id','term_id','student_id']);
            $table->integer('settings_id')->unsigned();
            $table->integer('session_id')->unsigned();
            $table->integer('term_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->string('student_name');
            $table->integer('classroom_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->foreign('session_id')->references('id')->on('session')->onDelete('cascade');
            $table->foreign('term_id')->references('id')->on('terms')->onDelect('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelect('cascade');
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelect('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelect('cascade');
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
        Schema::dropIfExists('student_session');
    }
}
