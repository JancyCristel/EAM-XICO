<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pagopay extends Controller
{
    public function index()
    {
        // Recuperar el carrito de la sesión
        $userId = auth()->id(); // Obtener el ID del usuario autenticado
        $cartKey = 'cart_' . $userId; // Crear la clave del carrito para el usuario
        $cart = session()->get($cartKey, []); // Obtener el carrito desde la sesión
        
        // Calcular el total
        $total = array_sum(array_map(function ($item) {
            return isset($item['price']) && isset($item['quantity']) 
                ? $item['price'] * $item['quantity'] 
                : 0;
        }, $cart));

        // Retornar a la vista de pago, pasando el carrito y el total
        return view('pago', compact('cart', 'total')); // Asegúrate de que el nombre de la vista sea correcto
    }
}
