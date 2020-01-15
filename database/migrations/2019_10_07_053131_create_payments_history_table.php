<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->integer('payment_id');
            $table->integer('amount');
            $table->string('reference_no')->unique();
            $table->string('description');
            $table->string('date_paid');
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
        Schema::dropIfExists('payments_history');
    }
}
