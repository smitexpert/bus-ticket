<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusBordingPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_bording_points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bus_schedule_id');
            $table->unsignedBigInteger('bus_counter_id');
            $table->time('arr_time');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('bus_schedule_id')->references('id')->on('bus_schedules')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bus_counter_id')->references('id')->on('bus_counters')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bus_bording_points');
    }
}
