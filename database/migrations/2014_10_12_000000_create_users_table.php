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
            $table->string('name')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('fullname');
            $table->string('website')->nullable();
            $table->string('token');
            $table->string("token_reset_password")->nullable();
            $table->dateTime('token_reset_password_expired')->nullable();
            $table->dateTime('token_expired');
            $table->string('company_name')->nullable();
            $table->string('description')->nullable();
            $table->string('avatar')->nullable();
            $table->string('start_time')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->Date('active_expired');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->Integer('status')->default(0);
            $table->Integer('roles')->default(0);
            $table->rememberToken();
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
