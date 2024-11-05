<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'productos'; // Asegúrate de que el nombre de la tabla sea correcto
    protected $fillable = ['nombre', 'precio']; // Incluye los campos que deseas permitir para la asignación masiva

    // Si tienes una relación inversa, la puedes definir aquí
    public function carritos()
    {
        return $this->hasMany(Carrito::class, 'product_id');
    }
}
