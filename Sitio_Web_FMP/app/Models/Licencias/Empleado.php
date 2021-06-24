<?php

namespace App\Models\Licencias;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $table = 'empleado';
    protected $guarded = ['id'];
    protected $fillable = [
        'nombre',
        'apellido',
        'dui',
        'nit',
        'telefono',
        'urlfoto',
        'estado',
        'tipo_jefe',
        'jefe',
    ];
}

