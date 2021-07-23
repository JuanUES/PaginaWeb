<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionCargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion_carga', function (Blueprint $table) {
            $table->id();
            $table->string('dias');
            $table->bigInteger('id_empleado');
            $table->bigInteger('id_carga');
            $table->foreign('id_empleado')
            ->references('id')
            ->on('empleado')
            ->onDelete('cascade');
            $table->foreign('id_carga')
            ->references('id')
            ->on('carga_admin')
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
        Schema::dropIfExists('asignacion_carga');
    }
}
