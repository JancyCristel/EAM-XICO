<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Muestra la vista de registro de usuario.
     */
    public function create()
    {
        return view('cliente-register');
    }

    /**
     * Registra un nuevo usuario y lo redirige al inicio de sesión.
     */
    public function store(Request $request)
    {


        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'no_telefono' => 'required|numeric',
            'sexo' => 'required|in:Masculino,Femenino,Prefiero no decirlo',
            'direccion_fiscal' => 'nullable|string|max:255', // Ya no es obligatorio
            'rfc' => 'nullable|string|max:255', // Ya no es obligatorio
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        

        // Crear un nuevo usuario
        $nuevo = new User();
        $nuevo->name = $request->name;
        $nuevo->apellido_paterno = $request->apellido_paterno;
        $nuevo->apellido_materno = $request->apellido_materno;
        $nuevo->fecha_nacimiento = $request->fecha_nacimiento;
        $nuevo->no_telefono = $request->no_telefono;
        $nuevo->sexo = $request->sexo;
        $nuevo->direccion = $request->direccion;
        $nuevo->direccion_envio = $request->direccion_envio;
        $nuevo->direccion_fiscal = $request->direccion_fiscal;
        $nuevo->referencias = $request->referencias;
        $nuevo->rfc = $request->rfc;
        $nuevo->rol = 'Cliente';  // Asignar rol por defecto
        $nuevo->email = $request->email;
        $nuevo->password = Hash::make($request->password);
        $nuevo->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('login.index')->with('success', 'Usuario registrado correctamente. Por favor, inicia sesión.');
    }
}
