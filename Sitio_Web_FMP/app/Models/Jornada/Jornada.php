<?php

namespace App\Models\Jornada;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    use HasFactory;
    protected $table = 'jornada';

    protected $guarded = 'id';

    protected $fillable = ['id_emp', 'id_periodo','estado'];

    public function items(){
        return $this->hasMany(JornadaItem::class, 'id_jornada', 'id');
    }

    public function items_enabled($estado){
        return $this->items()->select('dia', 'hora_inicio', 'hora_fin', 'id_jornada')->where('estado', '=', $estado)->get();
    }

    public function periodo_rf(){
        return $this->hasOne(Periodo::class, 'id', 'id_periodo');
    }

    public function empleado_rf(){
        return $this->hasOne(Empleado::class, 'id', 'id_emp');
    }

}
