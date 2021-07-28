<?php

namespace App\Models\Jornada;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'periodo';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha_inicio', 'fecha_fin', 'tipo', 'estado'];
}
