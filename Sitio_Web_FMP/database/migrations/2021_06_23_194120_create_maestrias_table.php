<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaestriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maestrias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('titulo');
            $table->string('modalidad')->nullable();;
            $table->string('duracion')->nullable();;
            $table->string('numero_asignatura')->nullable();;
            $table->string('unidades_valorativas')->nullable();;
            $table->string('precio')->nullable();;
            $table->longtext('contenido')->nullable();;
            $table->bigInteger('user');
            $table->boolean('estado');
            $table->bigInteger('PDF')->nullable();
            $table->foreign('PDF')
                ->references('id')
                ->on('p_d_f_s');
            $table->foreign('user')
                ->references('id')
                ->on('users');
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
        Schema::dropIfExists('maestrias');
    }
}
