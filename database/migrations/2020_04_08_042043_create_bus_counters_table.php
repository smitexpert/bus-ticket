<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_counters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('bus_organizations_id');
            $table->unsignedBigInteger('agent_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('bus_organizations_id')->references('id')->on('bus_organizations')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bus_counters');
    }
}
