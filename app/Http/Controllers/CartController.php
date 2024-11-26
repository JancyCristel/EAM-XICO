<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Muestra el contenido del carrito
    public function index()
    {
        $userId = auth()->id();
        $cartKey = 'cart_' . $userId;
        $cart = session()->get($cartKey, []);
        $totalItems = array_sum(array_column($cart, 'quantity'));

        return view('cart.show', compact('cart', 'totalItems'));
    }


    public function getCount()
{
    $userId = auth()->id();
    $cartKey = 'cart_' . $userId;
    $cart = session()->get($cartKey, []);
    $totalItems = array_sum(array_column($cart, 'quantity'));

    return response()->json(['count' => $totalItems]);
}

    // Agrega un producto al carrito
    public function add(Request $request, $id) {
        $cartKey = 'cart_' . auth()->id();
        $cart = session()->get($cartKey, []);

        // Obtiene el producto de la base de datos
        $product = Producto::find($id);
        if (!$product) {
            return redirect()->back()->withErrors('Producto no encontrado.');
        }

        // Lógica para agregar el producto al carrito
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->nombre,
                "quantity" => 1,
                "price" => $product->precio
            ];
        }

        session()->put($cartKey, $cart);

        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }

    // Actualiza la cantidad de un producto en el carrito
    public function update(Request $request, $id) {
        $cartKey = 'cart_' . auth()->id();
        $cart = session()->get($cartKey, []);

        // Lógica para actualizar la cantidad del producto
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
        }

        session()->put($cartKey, $cart);

        return redirect()->back()->with('success', 'Carrito actualizado.');
    }

    // Elimina un producto del carrito
    public function remove($id) {
        $cartKey = 'cart_' . auth()->id();
        $cart = session()->get($cartKey, []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put($cartKey, $cart);

        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }

    public function seleccionarDireccion()
    {
        $userId = auth()->id(); // Obtener el ID del usuario autenticado
        $cartKey = 'cart_' . $userId; // Crear la clave del carrito para el usuario
        $cart = session()->get($cartKey, []); // Obtener el carrito desde la sesión

        // Calcular el total
        $total = array_sum(array_map(function ($item) {
            return isset($item['price']) && isset($item['quantity'])
                ? $item['price'] * $item['quantity']
                : 0;
        }, $cart));

        // Retornar a la vista de selección de dirección, pasando el carrito y el total
        return view('Seleccionar-Direccion', compact('cart', 'total')); // Asegúrate de que el nombre de la vista sea correcto
    }

    public function stripe()
{
    $userId = auth()->id(); // Obtener el ID del usuario autenticado
    $cartKey = 'cart_' . $userId; // Crear la clave del carrito para el usuario
    $cart = session()->get($cartKey, []); // Obtener el carrito desde la sesión

    // Calcular el total
    $total = array_sum(array_map(function ($item) {
        return isset($item['price']) && isset($item['quantity'])
            ? $item['price'] * $item['quantity']
            : 0;
    }, $cart));

    // Retornar a la vista de Stripe, pasando el carrito y el total
    return view('stripe.index', compact('cart', 'total'));
}

    
}





