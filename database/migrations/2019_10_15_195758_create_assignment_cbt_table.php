<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentCbtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_cbt', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->string('assignment_code');
            $table->boolean('status')->default(0);
            $table->integer('score')->nullable()->default(0);
            $table->integer('subject_id');
            $table->string('answer')->default('y')->nullable();
            $table->date('due')->nullable();
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
        Schema::dropIfExists('assignment_cbt');
    }
}
