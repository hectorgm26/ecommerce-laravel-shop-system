<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/hola', function () {
    $nombre = "Hector Gonzalez";
    return "Hola desde Laravel {$nombre}";
});

// Capturando segmentos de la URL definiendo parametros en las rutas
Route::get('/usuario/{nombre?}', function ($nombre = 'Invitado') {
    return "Usuario: $nombre";
});

// Agrupacion de rutas con un prefijo, el cual se aplica a todas las rutas dentro del grupo, y se tendra que ingresar en la URL antes de la ruta
Route::group(['prefix' => 'admin'], function () {
    Route::get('dashboard', function () {
        return "Admin Dashboard";
    });
});

// Route::view('/producto', 'producto');
Route::get('/producto', function () {

    // Pasando datos a la vista de diferentes maneras

    // return view('almacen.producto', ['nombre' => 'Impresora LX300', 'marca' => 'Epson']);
    // return view('almacen.producto')->with(['nombre' => 'Impresora LX300', 'marca' => 'Epson']);

    // Con compact, que crea un array asociativo con las variables que se le pasan, y se colocan como claves en el array, sin poner el signo de dolar
    $nombre = "Impresora LX300";
    $marca = "Epson";;
    return view('almacen.producto', compact('nombre', 'marca'));
});

Route::get('/condicional/{nota?}', function ($nota = 12) {
    return view('estructuras.condicional', compact('nota'));
});

Route::get('/probar-conexion', function () {
    try {
        DB::connection()->getPdo();
        return "Conexión a la base de datos exitosa.";
    } catch (\Exception $e) {
        return "No se pudo conectar a la base de datos. <br> Error: " . $e->getMessage();
    }
});

// Query Builder
Route::get('/query', function () {
    $entradas = DB::table('entradas')->get();
    return $entradas;
});

Route::get('/filtro', function () {
    $entradas = DB::table('entradas')
        ->where('user_id', 1)
        ->where('titulo', 'LIKE', 'a%')
        ->orWhere('titulo', 'LIKE', 'b%')->get();
    return $entradas;
});

// WhereNull
// WhereNotNull
// WhereIn
// WhereNotIn
// WhereBetween
// WhereNotBetween

Route::get('/join', function () {
    $entradas = DB::table('entradas')
        ->join('users', 'entradas.user_id', '=', 'users.id') // De mi tabla entradas, su campo user_id, lo comparo con el campo id de la tabla users
        ->select('entradas.id', 'entradas.titulo', 'entradas.tag', 'entradas.imagen', 'users.email') // sE SELEccionan campos especificos a mostrar
        ->get();
    return $entradas;
});

// Left Join
// Right Join
// Cross Join

Route::get('/insert', function () {
    $insertado = DB::table('users')
        ->insert([
            'name' => 'Juan Perez',
            'email' => 'juan@prueba.cl',
            'password' => 'juan'
        ]);
    return $insertado;
});

// Obtener el ID del registro insertado
Route::get('/getId', function () {
    $id = DB::table('users')
        ->insertGetId([
            'name' => 'Juan Perez',
            'email' => '',
            'password' => ''
        ]);
    return $id; // No retornada un true o false si se logro insertar (1 o 0), sino el ID del registro insertado
});

// RUTAS CON CONTROLADORES

//Route::get('/entrada', [EntradaController::class, 'index']);
//Route::resource('entrada', EntradaController::class);
// Route::resource('entrada', EntradaController::class)->only('index', 'show');
// Route::resource('entrada', EntradaController::class)->except('destroy', 'update');

Route::get('/respuesta', function () {
    return response('Hola, esta es una respuesta', 200);
});
