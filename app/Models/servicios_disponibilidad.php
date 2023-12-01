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
        'rango_minutos',
        'visibilidad',
        'profesional_id',
        'rango_lunes',
        'rango_martes',
        'rango_miercoles',
        'rango_jueves',
        'rango_viernes',
        'rango_sabado',
        'rango_domingo',
    ];
   
}
