<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'posicion',
        'numero_camiseta', // Cambiado de 'numero' a 'numero_camiseta'
        'club', // Cambiado de 'equipo' a 'club'
        'edad', // Asumiendo que 'edad' se refiere a la edad del jugador
        'fecha_nacimiento', // No se cambió, asumiendo que se refiere a la fecha de nacimiento
    ];
}
