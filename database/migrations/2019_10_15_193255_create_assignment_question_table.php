<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_question', function (Blueprint $table) {
            $table->increments('id');
            $table->text('question');
            $table->string('A');
            $table->string('B');
            $table->string('C');
            $table->string('D');
            $table->string('answer');
            $table->integer('subject_id');
            $table->integer('classroom_id');
            $table->string('section_id');
            $table->string('assignment_code');
            $table->integer('teacher_id');
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
        Schema::dropIfExists('assignment_question');
    }
}
