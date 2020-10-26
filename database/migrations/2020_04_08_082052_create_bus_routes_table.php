<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_routes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from');
            $table->unsignedBigInteger('to');
            $table->unsignedBigInteger('bus_organization_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('from')->references('id')->on('districts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to')->references('id')->on('districts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bus_organization_id')->references('id')->on('bus_organizations')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bus_routes');
    }
}
