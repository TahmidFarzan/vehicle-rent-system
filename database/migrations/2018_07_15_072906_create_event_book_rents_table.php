<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventBookRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_book_rents', function (Blueprint $table) {
           $table->increments('id');
            $table->string('name',100);
            $table->string('mobile',112);
            $table->string('email',50);
            $table->text('description');
            $table->integer('vehicle_amount');
            $table->integer('ticket_amount');
            $table->string('price',11);
            $table->integer('vehicle_type_id')->unsigned();
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types')->onDelete('cascade');
            $table->integer('event_detail_id')->unsigned();
            $table->foreign('event_detail_id')->references('id')->on('event_details')->onDelete('cascade');
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
        Schema::dropIfExists('event_book_rents');
    }
}
