<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent', function (Blueprint $table) {
            $table->increments('id');
            $table->string('father_name');
            $table->string('father_email');
            $table->string('father_occupation');
            $table->integer('father_phone');
            $table->string('mother_name');
            $table->string('mother_email');
            $table->string('mother_occupation');
            $table->string('mother_phone');
            $table->string('is_guardian')->nullable();
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
        Schema::dropIfExists('parent');
    }
}
