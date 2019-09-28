<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleRentPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_rent_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vehicle_type_id')->unsigned();
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types')->onDelete('cascade');
            $table->integer('route_id')->unsigned();
            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');
            $table->float('total_price');
            $table->float('rent_price');
            $table->float('distance_price');
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
        Schema::dropIfExists('vehicle_rent_prices');
    }
}
