<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_teacher', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('classroom_id')->unsigned();
            $table->integer('teacher_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->integer('session_id')->unsigned();
            $table->integer('term_id')->unsigned();
           $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
           $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('session_id')->references('id')->on('session')->onDelete('cascade');
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
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
        Schema::dropIfExists('classroom_teacher');
    }
}
