<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->integer('order_id');
            $table->string('order_code')->nullable();
            $table->string('sale_code')->nullable();
            $table->integer('quantity');
            $table->integer('product_id');
            $table->string('product');
            $table->boolean('collected')->default(0);
            $table->string('comments')->nullable();
            $table->string('date_shipped');
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
        Schema::dropIfExists('order_product');
    }
}
