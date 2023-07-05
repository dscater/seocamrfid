<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresoSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingreso_salidas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('obra_id')->unsigned();
            $table->bigInteger('mo_id')->unsigned();
            $table->double('cantidad', 8, 2);
            $table->string('tipo');
            $table->date('fecha_registro');
            $table->timestamps();

            $table->foreign('obra_id')->references('id')->on('obras')->ondelete('no action')->onupdate('cascade');
            $table->foreign('mo_id')->references('id')->on('material_obras')->ondelete('no action')->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingreso_salidas');
    }
}
