<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventPriceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_price_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vehicle_type_id')->unsigned();
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types')->onDelete('cascade');
            $table->integer('event_detail_id')->unsigned();
            $table->foreign('event_detail_id')->references('id')->on('event_details')->onDelete('cascade');
            $table->integer('ticket_price');
            $table->integer('vehicle_price');
            $table->integer('total_price');
            $table->integer('admin_id')->unsigned();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
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
        Schema::dropIfExists('event_price_details');
    }
}
