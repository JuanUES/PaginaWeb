<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectosocialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectosociales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_empleado');
            $table->string('enunciado');
            $table->integer('cantidad');
            $table->foreign('id_empleado')
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
        Schema::dropIfExists('proyectosociales');
    }
}
