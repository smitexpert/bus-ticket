<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatReservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seat_reserves', function (Blueprint $table) {
            $table->id();
            $table->string('seat');
            $table->unsignedBigInteger('bus_schedule_id');
            $table->date('date');
            $table->timestamps();
            $table->foreign('bus_schedule_id')->references('id')->on('bus_schedules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seat_reserves');
    }
}
