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
        Schema::dropIfExists('proyectosociales');
        Schema::dropIfExists('trabajogrados');
       
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

        Schema::create('proyectosociales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_empleado');
            $table->bigInteger('id_carga');
            $table->bigInteger('id_ciclo');
            $table->integer('cantidad');

            $table->foreign('id_carga')
            ->references('id')
            ->on('carga_admins')
            ->onDelete('cascade');

            $table->foreign('id_empleado')
            ->references('id')
            ->on('empleado')
            ->onDelete('cascade');
            
            $table->foreign('id_ciclo')
            ->references('id')
            ->on('ciclos')
            ->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('trabajogrados', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_empleado');
            $table->bigInteger('id_carga');
            $table->bigInteger('id_ciclo');
            $table->integer('cantidad');

            $table->foreign('id_empleado')
            ->references('id')
            ->on('empleado')
            ->onDelete('cascade');

            $table->foreign('id_carga')
            ->references('id')
            ->on('carga_admins')
            ->onDelete('cascade');

            $table->foreign('id_ciclo')
            ->references('id')
            ->on('ciclos')
            ->onDelete('cascade');

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
