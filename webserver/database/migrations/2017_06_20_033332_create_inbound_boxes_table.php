<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInboundBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inbound_boxes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('box_id')->unsigned();
            $table->foreign('box_id')->references('id')->on('boxes');
            $table->date('exp_arrival_date');
            $table->date('act_arrival_date')->nullable();
            $table->string('arrival_destination');
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees');
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
        Schema::dropIfExists('inbound_boxes');
    }
}
