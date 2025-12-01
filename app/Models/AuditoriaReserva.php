<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditoriaReserva extends Model
{
    protected $table = 'auditoriareserva';
    protected $primaryKey = 'auditoria_id';
    public $timestamps = true;

    protected $fillable = [
        'reserva_id',
        'admin_id',
        'estado_anterior',
        'estado_nuevo',
        'observaciones',
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'reserva_id');
    }

    public function administrador()
    {
        return $this->belongsTo(Administrador::class, 'admin_id');
    }
}

