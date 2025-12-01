<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrador extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'administrador';
    protected $primaryKey = 'admin_id';
    public $timestamps = true;

    protected $fillable =[
        'usuario',
        'contrasena_hsh',
        'rol',
        'comunidad_id',
        'estado',
    ];

    protected $hidden =[
        'contrasena_hsh',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'created_at'=>'datetime',
            'updated_at'=>'datetime',
        ];
    }

    public function getAuthPassword()
    {
        return $this->contrasena_hsh;
    }
}
