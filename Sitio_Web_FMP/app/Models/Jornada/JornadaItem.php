<?php

namespace App\Models\Jornada;

use Illuminate\Database\Eloquent\Model;

class JornadaItem extends Model
{
    use HasFactory;
    protected $table = 'jornadaitem';

    protected $guarded = ['id'];
    protected $fillable = ['dia', 'hora_inicio', 'hora_fin', 'id_jornada'];
}
