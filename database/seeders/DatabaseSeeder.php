<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// DatabaseSeeder es el punto de entrada de todos los seeders.
// Cuando ejecutamos php artisan db:seed, Laravel llama a este archivo,
// y este a su vez llama a los seeders específicos que necesitamos.
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // $this->call() ejecuta los seeders en el orden en que los ponemos.
        // Si tuviéramos más tablas, añadiríamos más seeders aquí.
        $this->call([
            VideojocSeeder::class,
        ]);
    }
}
