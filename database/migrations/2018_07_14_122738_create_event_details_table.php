<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->integer('event_type_id')->unsigned();
            $table->foreign('event_type_id')->references('id')->on('event_types')->onDelete('cascade');
            $table->text('address');
            $table->text('map');
            $table->text('descriptaion')->nullable();
            $table->text('organizar')->nullable();
            $table->text('patner')->nullable();
            $table->time('start_time');
            $table->date('start_date');
            $table->time('end_time');
            $table->date('end_date');
            $table->text('image_name');
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
        Schema::dropIfExists('event_details');
    }
}
