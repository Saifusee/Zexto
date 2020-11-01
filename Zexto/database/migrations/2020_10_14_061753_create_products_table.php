<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_name');
            $table->string('product_for')->default('All');
            $table->longText('product_introduction');
            $table->longText('product_features');
            $table->float('product_amount');
            $table->float('product_previous_amount');
            $table->float('product_amount_with_taxes');
            $table->float('product_previous_amount_with_taxes');
            $table->integer('product_stock')->default(0);
            $table->string('product_main_image')->nullable();
            $table->string('product_description_image')->nullable();
            $table->string('product_sub_image_1')->nullable();
            $table->string('product_sub_image_2')->nullable();
            $table->string('product_sub_image_3')->nullable();
            $table->string('product_sub_image_4')->nullable();
            $table->string('product_sub_image_5')->nullable();
            $table->string('product_sub_image_6')->nullable();
            $table->integer('product_ratings')->default(0);
            $table->string('product_colors');
            $table->string('product_size');
            $table->float('product_weight');
            $table->text('product_tags')->nullable();
            $table->integer('product_category')->nullable();
            $table->bigInteger('vendor_id')->unsigned();
            $table->enum('product_status', ['Approved', 'Disapproved'])->default('Approved');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
