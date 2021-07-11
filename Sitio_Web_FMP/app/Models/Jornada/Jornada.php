<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'jornada';

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
    protected $fillable = ['id_emp', 'id_periodo'];

    public function items(){
        return $this->hasMany(JornadaItem::class, 'id_jornada', 'id');
    }

    public function items_enabled($status){
        return $this->items()->select('dia', 'hora_inicio', 'hora_fin', 'id_jornada')->where('status', '=', $status)->get();
    }

    public function periodo_rf(){
        return $this->hasOne(Periodo::class, 'id', 'id_periodo');
    }

}
