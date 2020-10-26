<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->tinyInteger('class');
            $table->unsignedBigInteger('bus_organization_id');
            $table->unsignedBigInteger('bus_seat_plan_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('bus_organization_id')->references('id')->on('bus_organizations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bus_seat_plan_id')->references('id')->on('bus_seat_plans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buses');
    }
}
