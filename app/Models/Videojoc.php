<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Este modelo representa la tabla 'videojocs' de la base de datos.
// Eloquent lo usa para hacer consultas sin escribir SQL a mano.
class Videojoc extends Model
{
    // HasFactory → permite usar Videojoc::factory() para generar datos de prueba
    use HasFactory;

    // $fillable: lista de campos que se pueden rellenar con create() o update()
    // Si un campo no está aquí, Eloquent lo ignora aunque llegue en el request.
    // Esto protege contra que alguien envíe campos maliciosos (Mass Assignment Protection).
    protected $fillable = [
        'titol',          // nombre del videojuego
        'genere',         // género: RPG, FPS, Aventura...
        'plataforma',     // plataforma: PC, PS5, Xbox, Switch
        'any_llancament', // año de lanzamiento (número entero)
        'preu',           // precio en euros (decimal)
    ];
}
