<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conveyance extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion',
        'estado',
    ];

    public function typeTransportation(){
        return $this->hasMany('App\Models\TypeTransportation');
    }
}
