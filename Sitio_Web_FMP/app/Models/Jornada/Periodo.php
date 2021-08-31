<?php

namespace App\Models\Jornada;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;
    protected $table = 'periodos';

    protected $guarded = ['id'];

    protected $fillable = ['titulo','fecha_inicio', 'fecha_fin', 'tipo', 'estado', 'observaciones'];
}
