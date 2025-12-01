<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformacionClimatica extends Model
{
    protected $table = 'informacionclimatica';
    protected $primaryKey = 'clima_id';
    public $timestamps = true;

    protected $fillable = [
        'tipo_experiencia',
        'temporada',
        'mejor_epoca',
        'temp_max_promedio',
        'temp_min_promedio',
        'recomendacion_vestimenta',
        'consideraciones_especiales',
        'estado',
    ];
}
