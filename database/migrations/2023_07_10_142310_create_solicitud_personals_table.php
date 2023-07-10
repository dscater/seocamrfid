<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudPersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_personals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("solicitud_obra_id");
            $table->unsignedBigInteger("personal_id");
            $table->timestamps();

            $table->foreign("solicitud_obra_id")->on("solicitud_obras")->references("id");
            $table->foreign("personal_id")->on("personals")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud_personals');
    }
}
