<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servicios_disponibilidad extends Model
{
    use HasFactory;

    protected $fillable = [
        'servicio_id',
        'lunes',
        'martes',
        'miercoles',
        'jueves',
        'viernes',
        'sabado',
        'domingo',
        'limite_servico',
        'rango_minutos'
    ];
   
}
