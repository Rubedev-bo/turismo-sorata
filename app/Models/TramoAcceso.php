<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TramoAcceso extends Model
{
    protected $table = 'tramoacceso';
    protected $primaryKey = 'tramo_id';
    public $timestamps = true;

    protected $fillable = [
        'comunidad_id',
        'tramo_numero',
        'medio_transporte',
        'punto_partida',
        'horarios_aproximados',
        'duracion_estimada',
        'costo_aproximado',
        'imagen_referencia',
        'recomendaciones',
        'estado',
    ];

    public function comunidad()
    {
        return $this->belongsTo(Comunidad::class, 'comunidad_id');
    }
}
