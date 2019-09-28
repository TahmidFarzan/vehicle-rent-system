<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleBookRentRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_book_rent_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('mobile',112);
            $table->string('email',50);
            $table->date('journey_date');
            $table->date('return_date');
            $table->text('description');
            $table->integer('vehicle_amount');
            $table->integer('vehicle_type_id')->unsigned();
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types')->onDelete('cascade');
            $table->integer('route_id')->unsigned();
            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');
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
        Schema::dropIfExists('vehicle_book_rent_requests');
    }
}
