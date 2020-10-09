<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumText('comment_data');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('blog_id')->unsigned();
            $table->string('comment_status')->default('Approved');
            $table->string('comment_admin_status')->default('Admin-Approved');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('no action');
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade')->onUpdate('no action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs_comments');
    }
}
