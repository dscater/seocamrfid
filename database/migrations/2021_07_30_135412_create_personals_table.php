<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personals', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('paterno');
            $table->string('materno');
            $table->string('ci');
            $table->string('ci_exp');
            $table->string('cel')->nullable();
            $table->bigInteger('obra_id')->unsigned();
            $table->string('domicilio');
            $table->string('familiar_referencia', 255);
            $table->string('fono_familiar');
            $table->string('cel_familiar');
            $table->string('foto');
            $table->date('fecha_registro');
            $table->integer('estado');
            $table->timestamps();

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
        Schema::dropIfExists('personals');
    }
}
