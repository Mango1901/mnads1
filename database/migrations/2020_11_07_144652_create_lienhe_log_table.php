<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLienheLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lienhe_log', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id')->unsigned();
            $table->BigInteger('lienhe_id')->unsigned();
            $table->String('ip');
            $table->String('location');
            $table->String('mobile',20);
            $table->String('description');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
        Schema::table('lienhe_log',function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('lienhe_log',function (Blueprint $table){
            $table->foreign('lienhe_id')->references('id')->on('lienhe');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lienhe_log');
    }
}
