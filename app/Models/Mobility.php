<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobility extends Model
{
    use HasFactory;

    protected $fillable = [
        'idTrajectorie',
        'idTypeTransportation',
        'costo',
        'estado',
    ];

    public function typeTransportation(){
        return $this->belongsTo('App\Models\TypeTransportation','idTypeTransportation','id');
    }

    public function trajectorie(){
        return $this->belongsTo('App\Models\Trajectorie','idTrajectorie','id');
    }
}
