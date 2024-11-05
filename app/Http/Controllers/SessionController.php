<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaccion;
use App\Models\Producto;
use App\Models\Consiga;

class SessionController extends Controller
{
    public function create()
    {
        return view('welcome');
    }

    public function store()
    {
        if (auth()->attempt(request(['email', 'password'])) == false) {
            return back()->withErrors([
                'message' => 'El email o la password son incorrectos'
            ]);
        } else {
            // Cargar el carrito del usuario en la sesión
            $cart = auth()->user()->cart ? json_decode(auth()->user()->cart, true) : [];
            session(['cart' => $cart]);

            // Redirige según el rol del usuario
            if (auth()->user()->rol == 'Cliente') {
                return redirect('/');
            } elseif (auth()->user()->rol == 'Contador') {
                return redirect('/');
            } elseif (auth()->user()->rol == 'Encargado') {
                return redirect('/');
            } elseif (auth()->user()->rol == 'Supervisor') {
                $Usuarios = User::all();
                $CantidadUsuarios = count($Usuarios);
                $UltimoUsuarioRegistrado = User::latest()->first();
                $Transacciones = Transaccion::all();

                $ProductosNConsignados = Consiga::where('estado', 'Pendiente')->get();
                return view('home', compact('CantidadUsuarios', 'UltimoUsuarioRegistrado', 'Transacciones', 'ProductosNConsignados'));
            } elseif (auth()->user()->rol == 'Vendedor') {
                return redirect('/');
            }
        }
    }

    public function manejarinicio()
    {
        if (auth()->check() != true) {
            return view('home');
        } elseif (auth()->user()->rol == 'Cliente') {
            return redirect('/');
        } elseif (auth()->user()->rol == 'Contador') {
            return redirect('/');
        } elseif (auth()->user()->rol == 'Encargado') {
            return redirect('/');
        } elseif (auth()->user()->rol == 'Supervisor') {
            $Usuarios = User::all();
            $CantidadUsuarios = count($Usuarios);
            $UltimoUsuarioRegistrado = User::latest()->first();
            $Transacciones = Transaccion::all();

            $ProductosNConsignados = Consiga::where('estado', 'Pendiente')->get();
            return view('home', compact('CantidadUsuarios', 'UltimoUsuarioRegistrado', 'Transacciones', 'ProductosNConsignados'));
        } elseif (auth()->user()->rol == 'Vendedor') {
            return redirect('/');
        }
    }

    public function destroy()
    {
        // Cierra la sesión del usuario
        auth()->logout();

        // Limpia los datos del carrito de la sesión para el usuario que cierra sesión
        session()->forget('cart');

        // Redirige a la página principal
        return redirect()->to('/');
    }
}



