<?php

namespace App\Http\Controllers;

use App\Models\Videojoc;
use Illuminate\Http\Request;

// Este controlador gestiona todos los endpoints de la API de videojuegos.
// Una API REST devuelve JSON en lugar de vistas HTML.
// Cada método corresponde a una ruta definida en routes/api.php.
class ApiController extends Controller
{
    // Devuelve todos los videojuegos de la base de datos
    // URL: GET /api/videojocs
    // Respuesta: JSON con el array completo de videojuegos
    public function index()
    {
        // Videojoc::all() hace un SELECT * FROM videojocs y devuelve una colección
        $videojocs = Videojoc::all();

        // response()->json() convierte el array PHP a formato JSON y lo envía al cliente
        // El 200 es el código HTTP que significa "OK, todo ha ido bien"
        return response()->json([
            'success' => true,
            'data'    => $videojocs
        ], 200);
    }

    // Devuelve un único videojuego buscado por su ID
    // URL: GET /api/videojocs/{id}   (ejemplo: GET /api/videojocs/3)
    // $id → viene del parámetro dinámico {id} de la URL
    public function show($id)
    {
        // find($id) hace un SELECT * WHERE id = $id
        // Si no encuentra nada, devuelve null (a diferencia de findOrFail que lanza excepción)
        $videojoc = Videojoc::find($id);

        // Si no existe el videojuego, devolvemos un error 404 (Not Found)
        if (!$videojoc) {
            return response()->json([
                'success' => false,
                'message' => 'Videojoc no trobat'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $videojoc
        ], 200);
    }

    // Crea un nuevo videojuego con los datos que llegan en el cuerpo de la petición
    // URL: POST /api/videojocs
    // Los datos se envían en formato JSON en el body de la petición (ej. desde Postman)
    public function store(Request $request)
    {
        // Validamos que todos los campos obligatorios lleguen con el formato correcto.
        // Si falla alguna validación, Laravel devuelve automáticamente un error 422.
        // El pipe | separa las reglas: 'required|string' significa "obligatorio Y de tipo texto"
        $request->validate([
            'titol'          => 'required|string',
            'genere'         => 'required|string',
            'plataforma'     => 'required|string',
            'any_llancament' => 'required|integer',
            'preu'           => 'required|numeric',
        ]);

        // create() hace un INSERT con todos los datos del request de golpe.
        // Solo funciona con los campos que están en el $fillable del modelo.
        $videojoc = Videojoc::create($request->all());

        // Devolvemos 201 (Created) en lugar de 200 porque hemos creado un nuevo recurso
        return response()->json([
            'success' => true,
            'message' => 'Videojoc creat correctament',
            'data'    => $videojoc
        ], 201);
    }

    // Elimina un videojuego por su ID
    // URL: DELETE /api/videojocs/{id}   (ejemplo: DELETE /api/videojocs/3)
    public function destroy($id)
    {
        $videojoc = Videojoc::find($id);

        // Si no existe, no podemos borrarlo → devolvemos 404
        if (!$videojoc) {
            return response()->json([
                'success' => false,
                'message' => 'Videojoc no trobat'
            ], 404);
        }

        // delete() hace un DELETE FROM videojocs WHERE id = $id
        $videojoc->delete();

        return response()->json([
            'success' => true,
            'message' => 'Videojoc eliminat correctament'
        ], 200);
    }

    // Busca videojuegos por género usando un parámetro de consulta en la URL
    // URL: GET /api/videojocs/cerca?genere=RPG
    // $request->query('genere') extrae el valor del parámetro ?genere= de la URL
    public function cerca(Request $request)
    {
        // query() → obtiene parámetros de la URL que van después del ?
        $genere = $request->query('genere');

        // where() añade un WHERE genere = $genere a la consulta SQL
        // get() ejecuta la consulta y devuelve una colección (aunque sea vacía)
        $videojocs = Videojoc::where('genere', $genere)->get();

        // isEmpty() comprueba si la colección no tiene ningún resultado
        if ($videojocs->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No s\'han trobat videojocs amb aquest gènere'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $videojocs
        ], 200);
    }
}
