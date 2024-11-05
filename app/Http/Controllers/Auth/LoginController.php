<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa Auth

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) { // Usa el facade Auth directamente
            $user = Auth::user();

            session()->forget('cart_' . $user->id);

            switch ($user->role) {
                case 'Encargado':
                    return redirect()->route('encargado');
                case 'Cliente':
                    return redirect()->route('cliente');
                case 'Contador':
                    return redirect()->route('contador');
                case 'Supervisor':
                    return redirect()->route('supervisor');
                case 'Vendedor':
                    return redirect()->route('vendedor');
                default:
                    return redirect('/home');
            }
        } else {
            return back()->withErrors(['email' => 'Correo electrónico o contraseña incorrectos.']);
        }
    }
}



