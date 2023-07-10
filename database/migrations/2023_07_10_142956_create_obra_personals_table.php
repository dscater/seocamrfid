<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObraPersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obra_personals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("obra_id");
            $table->unsignedBigInteger("personal_id");
            $table->timestamps();
            
            $table->foreign('obra_id')->references('id')->on('obras');
            $table->foreign('personal_id')->references('id')->on('personals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obra_personals');
    }
}
