<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObraHerramientasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obra_herramientas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("obra_id");
            $table->unsignedBigInteger("herramienta_id");
            $table->date("fecha_registro");
            $table->timestamps();

            $table->foreign('obra_id')->references('id')->on('obras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obra_herramientas');
    }
}
