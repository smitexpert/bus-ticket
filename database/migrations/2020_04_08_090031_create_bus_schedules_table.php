<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bus_organization_id');
            $table->unsignedBigInteger('bus_route_id');
            $table->unsignedBigInteger('seat_plan_id');
            $table->unsignedBigInteger('bus_id');
            $table->string('coach');
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->string('bus_number')->nullable();
            $table->float('charge');
            $table->integer('total_seat');
            $table->integer('available_seat');
            $table->integer('limit')->default(0);
            $table->time('dep_time');
            $table->time('arr_time');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('bus_organization_id')->references('id')->on('bus_organizations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bus_route_id')->references('id')->on('bus_routes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('seat_plan_id')->references('id')->on('bus_seat_plans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bus_schedules');
    }
}
