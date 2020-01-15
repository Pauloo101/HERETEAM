<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_sections', function (Blueprint $table) {
            // $table->increments('id');
            $table->primary(['classroom_id','sections_id']);
            $table->integer('classroom_id')->unsigned();
            // $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            $table->integer('sections_id')->unsigned();
            // $table->foreign('sections_id')->references('id')->on('sections')->onDelete('cascade');
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
        Schema::dropIfExists('classroom_sections');
    }
}
