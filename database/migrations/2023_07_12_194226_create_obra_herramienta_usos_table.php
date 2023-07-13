<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObraHerramientaUsosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obra_herramienta_usos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("obra_id");
            $table->unsignedBigInteger("obra_herramienta_id");
            $table->unsignedBigInteger("herramienta_id");
            $table->double("total_almacen");
            $table->double("total_uso");
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
        Schema::dropIfExists('obra_herramienta_usos');
    }
}
