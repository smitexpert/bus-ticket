<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusTransectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_transections', function (Blueprint $table) {
            $table->id();
            $table->string('trxID')->unique();
            $table->unsignedBigInteger('bus_ticket_id');
            $table->float('discount')->default(0);
            $table->float('service_charge')->default(0);
            $table->float('total');
            $table->string('payment_method');
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('bus_transections');
    }
}
