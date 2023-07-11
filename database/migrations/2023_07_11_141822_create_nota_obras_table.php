<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaObrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_obras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("obra_id");
            $table->text("nota");
            $table->date("fecha_registro");
            $table->timestamps();

            $table->foreign("obra_id")->on("obras")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nota_obras');
    }
}
