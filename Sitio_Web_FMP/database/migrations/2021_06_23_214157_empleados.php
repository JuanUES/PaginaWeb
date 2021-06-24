<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Empleados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('dui');
            $table->string('nit');
            $table->string('telefono');
            $table->string('urlfoto')->nullable();
            $table->boolean("estado");
            $table->integer('tipo_jefe');
            $table->bigInteger('jefe')->nullable();
            $table->foreign('jefe')
            ->references('id')
            ->on('empleado')
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
        Schema::dropIfExists('empleado');
    }
}
