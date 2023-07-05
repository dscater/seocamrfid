<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoreoHerramientasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoreo_herramientas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('herramienta_id')->unsigned();
            $table->string('accion');
            $table->date('fecha_registro');
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
        Schema::dropIfExists('monitoreo_herramientas');
    }
}
