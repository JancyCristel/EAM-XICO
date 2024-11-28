<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Pedido; // Importa el modelo Pedido

class StripeController extends Controller
{
    public function index()
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

    public function processPayment(Request $request)
    {
        try {
            // Validar los campos del formulario (Nombre, Correo Electrónico, Código Postal)
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'postal_code' => 'required|string|max:20',
            ]);

            // Configura tu clave secreta de Stripe
            Stripe::setApiKey(config('services.stripe.secret'));

            // Crea el cargo (con los detalles adicionales)
            $charge = Charge::create([
                'amount' => $request->total * 100, // Monto en centavos (Stripe maneja cantidades menores)
                'currency' => 'mxn',
                'description' => 'Pago de carrito',
                'source' => $request->stripeToken, // Token recibido de Stripe
                'receipt_email' => $request->email, // Enviar recibo al correo del usuario
                'shipping' => [
                    'name' => $request->name, // Nombre del titular
                    'address' => [
                        'postal_code' => $request->postal_code, // Código Postal
                    ],
                ],
            ]);

            // Verifica si el pago fue exitoso
            if ($charge->status === 'succeeded') {
                // Obtener los datos del carrito y del usuario
                $userId = auth()->id(); // ID del usuario autenticado
                $cartKey = 'cart_' . $userId; // Clave del carrito
                $cart = session()->get($cartKey, []); // Obtener carrito de la sesión

                // Guardar el pedido en la base de datos
                Pedido::create([
                    'user_id' => $userId,
                    'productos' => json_encode($cart), // Guardar productos como JSON
                    'estado' => 'pedido aceptado', // Estado inicial del pedido
                ]);

                // Limpiar el carrito de la sesión
                session()->forget($cartKey);

                // Redirige a la página de éxito
                return redirect()->route('payment.success')->with('success', 'Pago realizado con éxito.');
            } else {
                // Manejo de fallos
                return redirect()->route('payment.failed')->with('error', 'El pago no pudo completarse.');
            }
        } catch (\Exception $e) {
            // Manejo de excepciones
            return redirect()->route('payment.failed')->with('error', 'Hubo un problema con tu pago: ' . $e->getMessage());
        }
    }
}


