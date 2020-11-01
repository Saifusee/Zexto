<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTaxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_tax', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tax_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();

            $table->timestamps();

            $table->foreign('tax_id')->references('id')->on('taxes')->onDelete('no action')->onUpdate('no action');
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
        Schema::dropIfExists('product_tax');
    }
}
