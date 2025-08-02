<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'codigo',
        'nombre',
        'precio',
        'descripcion',
        'imagen',
    ]; // No es necesario agregar el 'id' ya que es autoincremental, y laravel asume que la tabla es el plural del modelo y que el campo id es la clave primaria
}
