<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Experiencia;

class ExperienciaSeeder extends Seeder
{
    public function run()
    {
        if (!Schema::hasTable('experiencia')) {
            return;
        }

        Experiencia::firstOrCreate([
            'nombre' => 'Caminata a mirador',
        ], [
            'comunidad_id' => 1,
            'descripcion_corta' => 'Caminata facil hasta el mirador',
            'precio_bs' => 50,
            'tipo_actividad' => 'caminata',
            'estado' => 'activa'
        ]);
    }
}
