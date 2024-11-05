<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pagopay extends Controller
{
    public function index()
    {
        // Recuperar el carrito de la sesión o de la base de datos
        $carrito = session('cart', []);
    
        // Asegúrate de que $carrito es un arreglo de objetos con producto y quantity
        $total = array_sum(array_map(function ($item) {
            return isset($item['producto']) && isset($item['producto']->precio) && isset($item['quantity']) 
                ? $item['producto']->precio * $item['quantity'] 
                : 0;
        }, $carrito));
    
        return view('pago', compact('carrito', 'total'));
    }
}


