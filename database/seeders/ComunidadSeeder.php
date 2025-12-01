<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Comunidad;

class ComunidadSeeder extends Seeder
{
    public function run()
    {
        // Solo insertar si la tabla existe
        if (!Schema::hasTable('comunidad')) {
            return;
        }

        Comunidad::firstOrCreate([
            'nombre' => 'Comunidad ejemplo',
        ], [
            'descripcion' => 'Comunidad de ejemplo para Sorata Pacha',
            'contacto_email' => 'info@ejemplo.com',
            'estado' => 'activa'
        ]);
    }
}
