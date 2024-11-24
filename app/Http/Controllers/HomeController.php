<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        // Validar los datos del formulario
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar iniciar sesión con las credenciales proporcionadas
        if (Auth::attempt($credentials)) {
            // La autenticación fue exitosa
            $user = Auth::user();

            // Redirigir según el rol del usuario
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
            // La autenticación falló
            return back()->withErrors(['email' => 'Correo electrónico o contraseña incorrectos.']);
        }
    }
    public function encargado()
    {
        return view('encargado');
    }
}
