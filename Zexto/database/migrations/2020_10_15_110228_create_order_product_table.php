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
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->integer('product_price')->comment('Price of product at the time when order takes place');
            $table->integer('product_total_price')->comment('Total price charge with all quantities requested.');
            $table->integer('product_quantity');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('no action')->onUpdate('no action');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('no action')->onUpdate('no action');

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
