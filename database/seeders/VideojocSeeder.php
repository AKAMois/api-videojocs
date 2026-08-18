<?php

namespace Database\Seeders;

use App\Models\Videojoc;
use Illuminate\Database\Seeder;

// Un Seeder puebla la base de datos con datos iniciales o de prueba.
// Se ejecuta con: php artisan db:seed
// O junto con la migración: php artisan migrate:fresh --seed
class VideojocSeeder extends Seeder
{
    public function run(): void
    {
        // factory() usa la VideojocFactory para generar los datos de cada registro
        // count(20) indica que queremos crear 20 videojuegos
        // create() los inserta en la base de datos
        Videojoc::factory()->count(20)->create();
    }
}
