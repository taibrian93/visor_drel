<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTransportation extends Model
{
    use HasFactory;

    protected $fillable = [
        'idConveyance',
        'descripcion',
        'estado',
    ];
}
