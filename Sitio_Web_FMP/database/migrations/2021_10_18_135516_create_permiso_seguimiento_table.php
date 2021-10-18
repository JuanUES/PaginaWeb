<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisoSeguimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permiso_seguimiento', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('permiso_id');
            $table->string('proceso');
            $table->text('observaciones')->nullable();
            $table->boolean('estado')->default(true);
            $table->foreign('permiso_id')->references('id')->on('permisos');
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
        Schema::dropIfExists('permiso_seguimiento');
    }
}
