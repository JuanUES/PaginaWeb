<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->string('numero_grupo');
            $table->string('tipo_grupo');
            $table->string('horas');
            $table->string('dias');
            $table->string('ciclo');
            $table->bigInteger('id_materia');
            $table->bigInteger('id_aula');
            $table->bigInteger('id_empleado');

            $table->foreign('id_materia')
            ->references('id')
            ->on('materias')
            ->onDelete('cascade');
            $table->foreign('id_aula')
            ->references('id')
            ->on('aulas')
            ->onDelete('cascade');
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
        Schema::dropIfExists('horarios');
    }
}
