<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAjustesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('fecha_uso_licencias');
        Schema::dropIfExists('permisos');
       
       
       
        Schema::create('permisos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('empleado');

            $table->string('tipo_representante') -> nullable();
            $table->string('tipo_permiso');
            $table->date('fecha_uso');
            $table->date('fecha_presentacion');
            $table->time('hora_inicio');
            $table->time('hora_final');
            $table->longText('justificacion');
            $table->longText('observaciones') -> nullable();
            $table->string('estado') -> nullable();

            $table->bigInteger('jefatura') -> nullable();
            $table->bigInteger('gestor_rrhh') -> nullable();
            
            $table->foreign('jefatura')->references('id')->on('empleado');
            $table->foreign('gestor_rrhh')->references('id')->on('empleado');
            $table->foreign('empleado')->references('id')->on('empleado');    

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
        //
    }
}
