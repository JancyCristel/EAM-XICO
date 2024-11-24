<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'calle',
        'numero_casa',
        'phone_number',
        'colonia',
        'estado',
        'municipio',
        'codigo_postal',
        'nombre_recibe',
        'referencias',
        'entre_calles',
        'is_default',
    ];
}


