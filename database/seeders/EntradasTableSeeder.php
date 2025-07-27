<?php

namespace Database\Seeders;

use App\Models\Entrada;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntradasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Para agregar entradas en la base de datos en la tabla 'entradas'
        /*
        Entrada::create([
            'user_id' => 1,
            'titulo' => 'Mi primera entrada',
            'tag' => 'Etiqueta 1',
            'contenido' => 'Este es el contenido del primer registro.',
            'imagen' => 'imagen1.jpg',
        ]);

        Entrada::create([
            'user_id' => 1,
            'titulo' => 'Segunda entrada',
            'tag' => 'Etiqueta 2',
            'contenido' => 'Este es el contenido del segundo registro.',
            'imagen' => 'imagen2.jpg',
        ]);
        */
    
        // para ejecutar este seeder, se debe usar el comando:
        // php artisan db:seed --class=EntradasTableSeeder (el nombre de la clase del seeder)

        // Generar entradas por el factory
        Entrada::factory()->count(100)->create();
    }
}
