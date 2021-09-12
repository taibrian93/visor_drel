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

    public function college(){
        return $this->hasMany('App\Models\College', 'codigoCentroPobladoMINEDU', 'codigoCentroPobladoMINEDU');
    }

    public function district(){
        return $this->belongsTo('App\Models\District','codigoUbigeoDistrito','codigoUbigeo');
    }
}
