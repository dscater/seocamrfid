<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudHerramientasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_herramientas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("solicitud_obra_id");
            $table->unsignedBigInteger("herramienta_id");
            $table->integer("dias_uso");
            $table->date("fecha_asignacion");
            $table->date("fecha_finalización");
            $table->timestamps();

            $table->foreign("solicitud_obra_id")->on("solicitud_obras")->references("id");
            $table->foreign("herramienta_id")->on("herramientas")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud_herramientas');
    }
}
