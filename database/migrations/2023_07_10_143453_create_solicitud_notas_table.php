<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_notas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("solicitud_obra_id");
            $table->text("nota");
            $table->timestamps();

            $table->foreign("solicitud_obra_id")->on("solicitud_obras")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud_notas');
    }
}
