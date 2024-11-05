<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carrito; // Asegúrate de que esto esté aquí
use App\Models\User;
use App\Models\Producto;

class CarritoSeeder extends Seeder
{
    public function run()
    {
        $user = User::first(); // Obtener un usuario existente
        $producto = Producto::first(); // Obtener un producto existente

        if ($user && $producto) {
            Carrito::create([
                'user_id' => $user->id,
                'product_id' => $producto->id,
                'quantity' => 2, // Puedes ajustar la cantidad
            ]);
        }
    }
}


