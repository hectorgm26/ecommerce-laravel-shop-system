<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hola', function () {
    $nombre = "Hector Gonzalez";
    return "Hola desde Laravel {$nombre}";
});

// Capturando segmentos de la URL definiendo parametros en las rutas
Route::get('/usuario/{nombre?}', function($nombre='Invitado') {
    return "Usuario: $nombre";
});

// Agrupacion de rutas con un prefijo, el cual se aplica a todas las rutas dentro del grupo, y se tendra que ingresar en la URL antes de la ruta
Route::group(['prefix' => 'admin'], function() {
    Route::get('dashboard', function() {
        return "Admin Dashboard";
    });
});

// Route::view('/producto', 'producto');
Route::get('/producto', function() {

    // Pasando datos a la vista de diferentes maneras

    // return view('almacen.producto', ['nombre' => 'Impresora LX300', 'marca' => 'Epson']);
    // return view('almacen.producto')->with(['nombre' => 'Impresora LX300', 'marca' => 'Epson']);

    // Con compact, que crea un array asociativo con las variables que se le pasan, y se colocan como claves en el array, sin poner el signo de dolar
    $nombre = "Impresora LX300";
    $marca = "Epson";;
    return view('almacen.producto', compact('nombre', 'marca'));
});

Route::get('/condicional/{nota?}', function($nota = 12) {
    return view('estructuras.condicional', compact('nota'));
});

Route::get('/control/{numero}', function($numero=2) {
    return view('estructuras.switch', compact('numero'));
});

Route::get('/while/{numero}', function($numero=2) {
    return view('estructuras.while', compact('numero'));
});

Route::get('/foreach', function() {
    $lista = ['Platanos', 'Manzanas', 'Peras', 'Fresas', 'Kiwi'];
    return view('estructuras.foreach', compact('lista'));
});

Route::get('/contacto', function() {
    return view ('contacto');
});

Route::get('/categoria', function() {
    return view('categoria');
});