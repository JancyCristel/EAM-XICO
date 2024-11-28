<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Pedido extends Model
{
    use HasFactory;

    // Si la tabla no se llama "pedidos" puedes especificar el nombre de la tabla aquí
    protected $table = 'pedidos'; 

    // Especifica los atributos que pueden ser asignados masivamente
    protected $fillable = ['user_id', 'productos', 'estado', 'created_at', 'updated_at'];
}
