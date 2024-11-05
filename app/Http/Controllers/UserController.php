<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Request\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function create(Request $request) //crear 1
    {
        return view('cliente-register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'no_telefono' => 'required|integer',
            'sexo' => 'required|in:Masculino,Femenino,Prefiero no decirlo',
            'direccion' => 'required|string|max:255',
            'rol' => 'required|in:Encargado,Cliente,Contador,Supervisor,Vendedor',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $nuevo = new User();
        $nuevo->name = $request->name;
        $nuevo->apellido_paterno = $request->apellido_paterno;
        $nuevo->apellido_materno = $request->apellido_materno;
        $nuevo->fecha_nacimiento = $request->fecha_nacimiento;
        $nuevo->no_telefono = $request->no_telefono;
        $nuevo->sexo = $request->sexo;
        $nuevo->direccion = $request->direccion;
        $nuevo->rol = $request->rol;
        $nuevo->email = $request->email;
        $nuevo->password = Hash::make($request->password);
        $nuevo->save();

        return response()->json([
            'message' => 'Usuario creado correctamente.',
            'user' => $nuevo,
        ], 201);
    }



}
