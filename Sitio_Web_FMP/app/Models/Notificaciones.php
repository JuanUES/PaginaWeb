<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model{
    use HasFactory;
    protected $table = 'notificaciones';

    protected $guarded = ['id'];
    protected $fillable = ['usuario_id','mensaje', 'tipo', 'estado'];
}
