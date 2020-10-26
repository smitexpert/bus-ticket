<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBkashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bkashes', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_trxid');
            $table->string('errorCode')->nullable();
            $table->string('errorMessage')->nullable();
            $table->string('paymentID')->nullable();
            $table->string('createTime')->nullable();
            $table->string('updateTime')->nullable();
            $table->string('trxID')->nullable();
            $table->string('transactionStatus')->nullable();
            $table->float('amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('intent')->nullable();
            $table->string('merchantInvoiceNumber')->nullable();
            $table->float('refundAmount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bkashes');
    }
}
