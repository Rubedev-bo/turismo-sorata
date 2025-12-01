<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comunidad extends Model
{
    protected $table = 'comunidad';
    protected $primaryKey = 'comunidad_id';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'imagen_representativa',
        'descripcion',
        'contacto_telefono',
        'contacto_email',
        'punto_partida_sorata',
        'dificultad_acceso',
        'recomendaciones_acceso',
        'estado'
    ];

    public function experiencias()
    {
        return $this->hasMany(Experiencia::class, 'comunidad_id');
    }

    public function tramos()
    {
        return $this->hasMany(TramoAcceso::class, 'comunidad_id');
    }

    public function administradores()
    {
        return $this->hasMany(Administrador::class, 'comunidad_id');
    }

    // Usar la clave primaria personalizada para el route model binding
    public function getRouteKeyName()
    {
        return 'comunidad_id';
    }
}