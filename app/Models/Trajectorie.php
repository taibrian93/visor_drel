<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trajectorie extends Model
{
    use HasFactory;

    protected $attributes = [
        'estado' => 1,
    ];

    protected $fillable = [
        'idRoute',
        'puntoPartida',
        'puntoLlegada',
        'distancia',
        'estado',
    ];

    
}
