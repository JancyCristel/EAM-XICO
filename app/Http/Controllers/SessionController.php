<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaccion;
use App\Models\Producto;
use App\Models\Consiga;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create()
    {
        return view('welcome'); // Mostramos la vista de login
    }

    public function store(Request $request)
    {
        // Mensajes personalizados para la validación
        $messages = [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Por favor ingresa un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ];

        // Validación del correo con mensajes personalizados
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',  // Solo requerimos que la contraseña esté presente
        ], $messages);

        // Verificar si el correo existe en la base de datos
        $user = User::where('email', $request->email)->first();

        // Si el correo no existe, redirigir con mensaje de error
        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'El correo electrónico no está registrado.']);
        }

        // Verificamos si la contraseña es válida
        if (strlen($request->password) < 6) {
            return redirect()->back()->withErrors(['error' => 'La contraseña es incorrecta.']);
        }

        // Intentar iniciar sesión con los datos del formulario
        if (Auth::attempt($request->only('email', 'password'))) {
            // Cargar el carrito del usuario en la sesión
            $cart = auth()->user()->cart ? json_decode(auth()->user()->cart, true) : [];
            session(['cart' => $cart]);

            // Redirigir según el rol del usuario
            switch (auth()->user()->rol) {
                case 'Cliente':
                case 'Contador':
                case 'Encargado':
                case 'Vendedor':
                    return redirect('/');
                case 'Supervisor':
                    $Usuarios = User::all();
                    $CantidadUsuarios = count($Usuarios);
                    $UltimoUsuarioRegistrado = User::latest()->first();
                    $Transacciones = Transaccion::all();
                    $ProductosNConsignados = Consiga::where('estado', 'Pendiente')->get();

                    return view('home', compact('CantidadUsuarios', 'UltimoUsuarioRegistrado', 'Transacciones', 'ProductosNConsignados'));
                default:
                    return redirect('/');
            }
        } else {
            // Si la autenticación falla, redirige con mensaje de error usando withErrors
            return redirect()->back()->withErrors(['error' => 'La contraseña es incorrecta.']);
        }
    }

    public function manejarinicio()
    {
        // Redirigir según el estado de autenticación
        if (auth()->check()) {
            switch (auth()->user()->rol) {
                case 'Cliente':
                case 'Contador':
                case 'Encargado':
                case 'Vendedor':
                    return redirect('/');
                case 'Supervisor':
                    $Usuarios = User::all();
                    $CantidadUsuarios = count($Usuarios);
                    $UltimoUsuarioRegistrado = User::latest()->first();
                    $Transacciones = Transaccion::all();
                    $ProductosNConsignados = Consiga::where('estado', 'Pendiente')->get();
                    return view('home', compact('CantidadUsuarios', 'UltimoUsuarioRegistrado', 'Transacciones', 'ProductosNConsignados'));
                default:
                    return redirect('/');
            }
        }

        // Si no está autenticado, vuelve a la vista de login
        return view('home');
    }

    public function destroy()
    {
        // Cierra la sesión del usuario
        auth()->logout();

        // Limpia los datos del carrito de la sesión
        session()->forget('cart');

        // Redirige a la página principal
        return redirect('/');
    }
}

