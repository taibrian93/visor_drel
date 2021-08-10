<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopulationCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigoUbigeoDistrito',
        'codigoCentroPobladoMINEDU',
        'x',
        'y',
        'descripcion',
        'estado',
    ];
}
