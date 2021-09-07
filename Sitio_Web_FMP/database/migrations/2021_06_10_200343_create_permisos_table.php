<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('tipo_permiso');
            $table->longText('justificacion');
            $table->integer('horas_utilizar');
            $table->date('fecha_presentacion_licencia');
            $table->longText('observaciones') -> nullable();
            $table->integer('representantes') -> nullable();
            $table->bigInteger('jefatura') -> nullable();
            $table->bigInteger('gestor_rrhh') ->nullable();

            $table->foreign('jefatura')
                ->references('id')
                ->on('empleado');

            $table->foreign('gestor_rrhh')
                ->references('id')
                ->on('empleado');
                
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
        Schema::dropIfExists('permisos');
    }
}
