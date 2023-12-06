<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosDisponibilidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios_disponibilidads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('servicio_id');
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');;
            $table->unsignedBigInteger('profesional_id');
            $table->foreign('profesional_id')->references('id')->on('profesionales')->onDelete('cascade');;
            $table->boolean('lunes')->default(false);
            $table->string("rango_lunes")->nullable();
            $table->boolean('martes')->default(false);
            $table->string("rango_martes")->nullable();
            $table->boolean('miercoles')->default(false);
            $table->string("rango_miercoles")->nullable();
            $table->boolean('jueves')->default(false);
            $table->string("rango_jueves")->nullable();
            $table->boolean('viernes')->default(false);
            $table->string("rango_viernes")->nullable();
            $table->boolean('sabado')->default(false);
            $table->string("rango_sabado")->nullable();
            $table->boolean('domingo')->default(false);
            $table->string("rango_domingo")->nullable();
            $table->integer('limite_servico');
            $table->integer('rango_minutos');
            $table->boolean('visibilidad');
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
        Schema::dropIfExists('servicios_disponibilidads');
    }
}
