<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->tinyInteger('gender')->nullable();
            $table->string('email_address');
            $table->string('paypal_email_address')->nullable();
            $table->string('username');
            $table->string('password');
            $table->tinyInteger('is_verified')->default(0);
            $table->string('profile')->nullable();
            $table->integer('count_post')->default(0);
            $table->integer('count_followers')->default(0);
            $table->integer('count_following')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
