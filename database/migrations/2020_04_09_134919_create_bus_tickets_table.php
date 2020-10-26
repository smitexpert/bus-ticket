<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_no')->unique();
            $table->unsignedBigInteger('bus_schedule_id');
            $table->unsignedBigInteger('bus_boarding_id');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_email')->nullable();
            $table->string('gender', 20);
            $table->integer('total_seat');
            $table->float('seat_charge');
            $table->date('date');
            $table->string('status')->default('reserved');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('bus_schedule_id')->references('id')->on('bus_schedules');
            $table->foreign('bus_boarding_id')->references('id')->on('bus_bording_points');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bus_tickets');
    }
}
