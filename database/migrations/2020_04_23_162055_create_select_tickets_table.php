<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelectTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('select_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('seat');
            $table->unsignedBigInteger('bus_schedule_id');
            $table->date('date');
            $table->time('time');
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
        Schema::dropIfExists('select_tickets');
    }
}
