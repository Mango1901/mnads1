<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGooglereportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google_reports', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id')->unsigned();
            $table->String('clicks_desktop',30);
            $table->String('cost_desktop',50);
            $table->String('ctr_desktop');
            $table->String('averageCpc_desktop');
            $table->String('impressions_desktop');
            $table->String('segments_desktop');
            $table->String('clicks_mobile',30);
            $table->String('cost_mobile',50);
            $table->String('ctr_mobile');
            $table->String('averageCpc_mobile');
            $table->String('impressions_mobile');
            $table->String('segments_mobile');
            $table->String('clicks_tablet',30);
            $table->String('cost_tablet',50);
            $table->String('ctr_tablet');
            $table->String('averageCpc_tablet');
            $table->String('impressions_tablet');
            $table->String('segments_tablet');
            $table->Integer('status')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->DEFAULT('0000-00-00 00:00:00');
        });
        Schema::table('google_reports',function (Blueprint $table){
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
        Schema::dropIfExists('google_reports');
    }
}
