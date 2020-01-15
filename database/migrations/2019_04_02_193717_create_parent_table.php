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
            $table->string('name');
            $table->string('father_name');
            $table->string('email')->unique();
            $table->string('father_occupation');
            $table->string('father_phone')->unique();
            $table->string('mother_name');
            $table->string('password');
            // $table->string('mother_email')->unique();
            $table->string('mother_occupation');
            $table->string('mother_phone')->unique();
            $table->string('token')->nullable();
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
