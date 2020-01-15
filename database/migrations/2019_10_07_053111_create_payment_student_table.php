<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_student', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_id');
            $table->integer('student_id');
            // $table->int('payments')->nullable();
            $table->text('payment_description')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_reference')->nullable();
            $table->boolean('status')->default(0);
            $table->integer('total')->nullable()->default(0);
            $table->integer('pending')->nullable()->default(0);
            $table->unique(['payment_id', 'student_id']);
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
        Schema::dropIfExists('payment_student');
    }
}
