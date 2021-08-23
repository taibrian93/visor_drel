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

    public function route(){
        return $this->belongsTo('App\Models\Route','idRoute','id');
    }

    public function mobility(){
        return $this->hasMany('App\Models\Mobility', 'idTrajectorie');
    }

    
}
