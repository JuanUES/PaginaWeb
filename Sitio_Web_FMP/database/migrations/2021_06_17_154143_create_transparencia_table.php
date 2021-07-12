<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransparenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transparencia', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('documento');
            $table->enum('publicar',['publicado', 'sin publicar'])->default('sin publicar');
            $table->enum('categoria', ['marco-normativo', 'marco-gestion', 'marco-presupuestario', 'estadisticas', 'documentos-JD']);
            $table->enum('subcategoria', ['agendas', 'actas', 'acuerdos'])->nullable();
            $table->enum('estado',['activo','inactivo'])->default('activo');
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
        Schema::dropIfExists('transparencia');
    }
}
