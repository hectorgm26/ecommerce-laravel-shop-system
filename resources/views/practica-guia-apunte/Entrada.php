<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{

    // Para usar un factory, se debe usar el trait HasFactory
    use HasFactory;

    // Si se usaron las convenciones de Laravel y el modelo es el singular de la tabla, este paso es opcional.
    // protected $table = 'entradas';

    //protected $primaryKey = 'id'; // Si la clave primaria no es 'id', se debe especificar cual sera el campo de  clave primaria

    protected $fillable = [
        'titulo',
        'tag',
        'contenido',
        'imagen',
        'user_id',
    ];

    // Una entrada pertenece a un usuario, y un usuario puede tener muchas entradas
    public function usuario() {
        return $this->belongsTo(User::class, 'user_id'); // El segundo parametro es el nombre de la clave foranea en la tabla entradas
    }
}
