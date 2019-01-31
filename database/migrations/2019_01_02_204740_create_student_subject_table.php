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
            $table->integer('student_id');
            $table->integer('subject_id');
            $table->primary(['student_id','subject_id']);
            $table->integer('testone')->nullable();
            $table->integer('testtwo')->nullable();
            $table->integer('testthree')->nullable();
            $table->integer('exam')->nullable();

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
