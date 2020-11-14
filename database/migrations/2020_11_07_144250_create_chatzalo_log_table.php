<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatzaloLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatzalo_log', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id')->unsigned();
            $table->BigInteger('zalo_id')->unsigned();
            $table->String('ip');
            $table->String('location');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
        Schema::table('chatzalo_log',function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('chatzalo_log',function (Blueprint $table){
            $table->foreign('zalo_id')->references('id')->on('chatzalo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chatzalo_log');
    }
}
