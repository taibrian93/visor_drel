<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'idCollege',
        'descripcion',
        'estado',
    ];

    public function college(){
        return $this->belongsTo('App\Models\College','idCollege','id');
    }

    public function trajectorie(){
        return $this->hasMany('App\Models\Trajectorie', 'idRoute');
    }
}
