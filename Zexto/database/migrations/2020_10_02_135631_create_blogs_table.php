<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('blog_title' );
            $table->longText('blog_data_1');
            $table->longText('blog_data_2')->nullable();
            $table->mediumText('blog_quote')->nullable();
            $table->string('blog_quote_author')->nullable();
            $table->string('blog_main_image')->nullable();
            $table->string('blog_status')->default("Disapproved");
            $table->string('blog_sub_image_1')->nullable();
            $table->string('blog_sub_image_2')->nullable();
            $table->string('blog_sub_image_3')->nullable();
            $table->string('category_tag' )->default('None');
            $table->text('product_tags' )->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
