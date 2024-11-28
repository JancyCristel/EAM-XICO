<?php

namespace App\Http\Controllers;

use App\Models\Pedido; // Importar el modelo Pedido
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function misPedidos()
    {
        $userId = auth()->id(); // Obtener el ID del usuario autenticado

        // Obtener los pedidos asociados al usuario desde la tabla 'pedidos' usando el modelo Pedido
        $pedidos = Pedido::where('user_id', $userId)
            ->orderBy('created_at', 'desc') // Ordenar los pedidos por fecha
            ->get(); // Obtener todos los pedidos

        // Retornar la vista 'pedidos.index' con los pedidos obtenidos
        return view('pedidos.index', compact('pedidos'));
    }
}


