<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('bookingDate');
            $table->bigInteger('noPerson');
            $table->rememberToken()->nullable();
            $table->bigInteger('advisorId')->unsigned();
            $table->foreign('advisorId')->references('id')->on('users');
            $table->bigInteger('clientId')->unsigned();
            $table->foreign('clientId')->references('id')->on('users');
            $table->string('status')->default('Waiting');
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
        Schema::dropIfExists('appointments');
        
    }
}
