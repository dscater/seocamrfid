<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialObrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_obras', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('material_id')->unsigned();
            $table->double('stock_minimo', 8, 2);
            $table->double('stock_actual', 8, 2);
            $table->string('estado_stock');
            $table->bigInteger('obra_id')->unsigned();
            $table->date('fecha_registro');
            $table->integer('estado');
            $table->timestamps();

            $table->foreign('material_id')->references('id')->on('materials')->ondelete('no action')->onupdate('cascade');
            $table->foreign('obra_id')->references('id')->on('obras')->ondelete('no action')->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_obras');
    }
}
