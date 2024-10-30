@extends('layouts.app')
@section('titulo', 'Registro de usuario') <!-- Establecer el título aquí -->
<link rel="stylesheet" href="/css/sign-up.css">

@section('contenido')

<div class="container-form">
    <h1>Crea tu cuenta</h1>
    <form action="{{ route('user.create') }}" method="POST">
        @csrf

        <div class="container-section">
            
            <div class="container-input">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="container-input">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input type="text" id="apellido_paterno" name="apellido_paterno" required>
            </div>

            <div class="container-input">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" id="apellido_materno" name="apellido_materno" required>
            </div>

            <div class="container-input">
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
            </div>

            <div class="container-input">
                <label for="no_telefono">Número de Teléfono</label>
                <input type="text" id="no_telefono" name="no_telefono" required>
            </div>

        </div>

        <div class="container-section">

            <div class="container-input">
                <label for="sexo">Sexo</label>
                <select id="sexo" name="sexo" required>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Prefiero no decirlo">Otro</option>
                </select>
            </div>

            <div class="container-input">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion" required>
            </div>
            @if(auth()->check())
                @if(auth()->user()->rol === 'Supervisor')
                    <label for="rol">Rol</label>
                    <select id="rol" name="rol" required>
                        <option value="Cliente">Cliente</option>
                        <option value="Vendedor">Vendedor</option>
                        <option value="Encargado">Encargado</option>
                        <option value="Contador">Contador</option>
                        <option value="Supervisor" selected>Supervisor</option>
                    </select><br>
                @elseif(auth()->user()->rol === 'Encargado')
                    <label for="rol">Rol</label>
                    <select id="rol" name="rol" required>
                        <option value="Cliente">Cliente</option>
                        <option value="Vendedor">Vendedor</option>
                    </select><br>
                @else
                    <input type="hidden" id="rol" name="rol" value="Cliente">
                @endif
            @else
                <input type="hidden" id="rol" name="rol" value="Cliente">
            @endif

            

            <div class="container-input">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" required>
            </div>

            <div class="container-input">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Registrar Usuario</button>

        </div>

    </form>
</div>

@endsection

