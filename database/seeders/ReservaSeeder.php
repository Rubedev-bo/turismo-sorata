<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Reserva;

class ReservaSeeder extends Seeder
{
    public function run()
    {
        if (!Schema::hasTable('reserva')) {
            return;
        }

        Reserva::firstOrCreate([
            'nombre_completo' => 'Cliente ejemplo',
            'email' => 'cliente@ejemplo.com'
        ], [
            'experiencia_id' => 1,
            'fecha_experiencia' => now()->addDays(5)->toDateString(),
            'numero_adultos' => 2,
            'numero_ninos' => 0,
            'telefono' => '00000000',
            'estado' => 'pendiente'
        ]);
    }
}
