<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
        $table->unsignedBigInteger('usuario_id');
        $table->unsignedBigInteger('servicio_id');
      
        $table->datetime('fecha_cita');
        $table->timestamps();

        $table->foreign('usuario_id')->references('id')->on('usuarios');
        $table->foreign('servicio_id')->references('id')->on('servicios');
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citas');
    }
}
