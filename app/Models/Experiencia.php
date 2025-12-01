<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experiencia extends Model
{
    protected $table = 'experiencia';
    protected $primaryKey = 'experiencia_id';
    public $timestamps = true;

    protected $fillable = [
        'comunidad_id',
        'nombre',
        'imagen_principal',
        'descripcion_corta',
        'descripcion_completa',
        'duracion_estimada',
        'precio_bs',
        'tipo_actividad',
        'estado',
    ];

    public function comunidad()
    {
        return $this->belongsTo(Comunidad::class, 'comunidad_id');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'experiencia_id');
    }
}
