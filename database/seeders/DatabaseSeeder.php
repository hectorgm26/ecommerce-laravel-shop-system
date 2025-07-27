<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */

        // Para llamar a todos los seeders y poder ejecutarlos (incluyendo factories)
        $this->call(EntradasTableSeeder::class); // agregando en el array de $seeders los seeders que se quieran ejecutar
    }
}
