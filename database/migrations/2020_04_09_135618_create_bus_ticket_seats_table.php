<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusTicketSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_ticket_seats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bus_ticket_id');
            $table->string('seat_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('bus_ticket_id')->references('id')->on('bus_tickets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bus_ticket_seats');
    }
}
