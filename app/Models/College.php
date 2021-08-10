<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigoCentroPobladoMINEDU',
        'codigoLocal',
        'codigoModular',
        'nombreCentroEducativo',
        'nombreDirector',
        'direccionCentroEducativo',
        'x',
        'y',
        'estado',
    ];

    public function route(){
        return $this->hasMany('App\Models\Route');
    }

}
