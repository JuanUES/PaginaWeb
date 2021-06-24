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
            $table->string('modalidad');
            $table->string('duracion');
            $table->string('numero_asignatura');
            $table->string('unidades_valorativas');
            $table->string('precio');
            $table->longtext('presentacion');
            $table->longtext('objetivo');
            $table->longtext('dirigido_a');
            $table->longtext('requisitos');
            $table->longtext('perfil_egresado');
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
