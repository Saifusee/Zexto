<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username' )->unique();
            $table->string('email' )->unique();
            $table->boolean('email_verified')->default(false);
            $table->string('firstname' )->nullable();
            $table->string('lastname' )->nullable();
            $table->string('password' );
            $table->string('profile_picture')->nullable();
            $table->boolean('is_vendor')->default(false);
            $table->boolean('is_admin')->default(false);
            $table->mediumText('remember_token')->nullable();
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
        Schema::dropIfExists('users');
    }
}
