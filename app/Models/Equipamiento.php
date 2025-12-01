<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipamiento extends Model
{
    protected $table = 'equipamiento';
    protected $primaryKey = 'equipamiento_id';
    public $timestamps = true;

    protected $fillable = [
        'tipo_actividad',
        'categoria',
        'item',
        'explicacion',
        'estado',
    ];
}
