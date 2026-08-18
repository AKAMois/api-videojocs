<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Una migración es como un script que crea o modifica tablas en la base de datos.
// Se ejecuta con: php artisan migrate
// Se deshace con: php artisan migrate:rollback
return new class extends Migration
{
    // up(): se ejecuta cuando hacemos migrate → CREA la tabla
    public function up(): void
    {
        Schema::create('videojocs', function (Blueprint $table) {
            $table->id();                        // columna 'id' autoincremental (clave primaria)
            $table->string('titol');             // nombre del videojuego (VARCHAR)
            $table->string('genere');            // género: RPG, FPS, etc. (VARCHAR)
            $table->string('plataforma');        // plataforma: PC, PS5, etc. (VARCHAR)
            $table->integer('any_llancament');   // año de lanzamiento (INT)
            $table->decimal('preu', 5, 2);       // precio con 5 dígitos en total y 2 decimales (ej: 59.99)
            $table->timestamps();                // crea 'created_at' y 'updated_at' automáticamente
        });
    }

    // down(): se ejecuta cuando hacemos rollback → ELIMINA la tabla
    public function down(): void
    {
        Schema::dropIfExists('videojocs');
    }
};
