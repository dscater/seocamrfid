<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacionUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacion_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('notificacion_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('visto');
            $table->timestamps();

            $table->foreign('notificacion_id')->references('id')->on('notificacions')->ondelete('no action')->onupdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->ondelete('no action')->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notificacion_users');
    }
}
