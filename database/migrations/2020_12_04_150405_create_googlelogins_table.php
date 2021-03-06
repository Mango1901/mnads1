<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoogleloginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google_logins', function (Blueprint $table) {
            $table->id();
            $table->BigInteger("user_id")->unsigned();
            $table->String("provider_user_id");
            $table->String("provider");
            $table->timestamps();
        });
        Schema::table('google_logins',function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('google_logins');
    }
}
