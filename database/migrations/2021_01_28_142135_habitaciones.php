<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Habitaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitaciones', function (Blueprint $table) {
            $table->integer('habitacion_id')->autoIncrement();
            $table->integer('tipo_habitacion_id');
            $table->string('nombre', 50)->unique();
            $table->boolean('estado')->default(true);
            $table->foreign('tipo_habitacion_id')->references('tipo_habitacion_id')
                ->on('tipos_habitacion')
                ->onDelete('cascade');
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
        Schema::dropIfExists('habitaciones');
    }
}
