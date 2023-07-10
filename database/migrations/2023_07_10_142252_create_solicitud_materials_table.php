<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("solicitud_obra_id");
            $table->unsignedBigInteger("material_id");
            $table->double("cantidad", 24, 2);
            $table->timestamps();

            $table->foreign("solicitud_obra_id")->on("solicitud_obras")->references("id");
            $table->foreign("material_id")->on("materials")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud_materials');
    }
}
