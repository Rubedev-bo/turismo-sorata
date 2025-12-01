<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reserva';
    protected $primaryKey = 'reserva_id';
    public $timestamps = true;

    protected $fillable = [
        'experiencia_id',
        'numero_reserva',
        'fecha_experiencia',
        'numero_adultos',
        'numero_ninos',
        'nombre_completo',
        'email',
        'telefono',
        'estado',
        'precio_total',
        'confirmacion_automatica',
        'fecha_confirmacion',
        'admin_id',
    ];

    public function experiencia()
    {
        return $this->belongsTo(Experiencia::class, 'experiencia_id');
    }

    public function administrador()
    {
        return $this->belongsTo(Administrador::class, 'admin_id');
    }

    public function auditorias()
    {
        return $this->hasMany(AuditoriaReserva::class, 'reserva_id');
    }
}
