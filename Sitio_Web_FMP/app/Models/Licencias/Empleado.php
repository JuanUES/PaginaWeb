<?php

namespace App\Models\Licencias;

use App\Models\Tipo_Jornada;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $table = 'empleado';
    protected $guarded = ['id'];
    protected $fillable = [
        'id_depto',
        'nombre',
        'apellido',
        'dui',
        'nit',
        'telefono',
        'urlfoto',
        'estado',
        'tipo_jefe',
        'jefe',
        'id_tipo_jornada',
        'id_tipo_contrato',
    ];

    public function tipo_jornada_rf(){
        return $this->hasOne(Tipo_Jornada::class, 'id', 'id_tipo_jornada');
    }

    public function tipo_contrato_rf(){
        return $this->hasOne(Tipo_Contrato::class, 'id', 'id_tipo_contrato');
    }
}

