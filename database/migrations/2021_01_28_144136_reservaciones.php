<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Reservaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservaciones', function (Blueprint $table) {
            $table->integer('reservacion_id')->autoIncrement();
            $table->integer('cliente_id');
            $table->integer('habitacion_id');
            $table->dateTime('check_in');
            $table->dateTime('check_out');
            $table->boolean('estado')->default(true);
            $table->timestamps();
            $table->foreign('habitacion_id')->references('habitacion_id')->on('habitaciones')->onDelete('cascade');
            $table->foreign('cliente_id')->references('cliente_id')->on('clientes')->onDelete('cascade');
            $table->unique(['habitacion_id', 'check_in']);
            $table->unique(['habitacion_id', 'check_out']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservaciones');
    }
}
