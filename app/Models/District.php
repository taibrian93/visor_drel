<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'idProvince',
        'codigoUbigeo',
        'descripcion',
        'estado',
    ];

    public function population_center(){
        return $this->hasMany('App\Models\PopulationCenter', 'codigoUbigeoDistrito', 'codigoUbigeo');
    }

    public function province(){
        return $this->belongsTo('App\Models\Province','idProvince','id');
    }
}
