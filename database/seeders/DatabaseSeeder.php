<?php

namespace Database\Seeders;

use App\Models\Administrador;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Administrador::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed inicial de ejemplo (no ejecutar automatico desde este script si no desea tocar la BD)
        $this->call([
            ComunidadSeeder::class,
            ExperienciaSeeder::class,
            ReservaSeeder::class,
        ]);
    }
}
