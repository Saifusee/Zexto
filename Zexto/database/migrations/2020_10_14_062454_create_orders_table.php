<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('local_txnid')->nullable();
            $table->string('payment_gateway_txnid')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->float('order_amount')->unsigned();
            $table->enum('order_status', [0, 1, 2, 3, 4])->default('2')->comment('0 = Fail || 1 = Success || 2 = In Progress || 3 = Cancel || 4 = Not Delivered');
            $table->enum('payment_status', [0, 1, 2, 3, 4])->default('2')->comment('0 = Fail || 1 = Success || 2 = In Progress || 3 = Cancel || 4 = Refund');
            $table->text('shipping_address');
            $table->string('shipping_zipcode');
            $table->text('payment_gateway_response')->nullable();
            $table->timestamp('order_completed_at')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
