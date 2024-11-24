@extends('layouts.app')
@section('titulo', 'Registro de usuario')
@section('contenido')
<link rel="stylesheet" href="{{ asset('css/sign-up.css') }}">

<div class="container-form">
    <h1>Crea tu cuenta</h1>

    @if($errors->any())
        <div id="error-message" class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.store') }}" method="POST" id="registerForm">
        @csrf

        <div class="container-section">
            <div class="container-input">
                <label for="name">Nombre <span>*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="container-input">
                <label for="apellido_paterno">Apellido Paterno <span>*</span></label>
                <input type="text" id="apellido_paterno" name="apellido_paterno" value="{{ old('apellido_paterno') }}" required>
            </div>

            <div class="container-input">
                <label for="apellido_materno">Apellido Materno <span>*</span></label>
                <input type="text" id="apellido_materno" name="apellido_materno" value="{{ old('apellido_materno') }}" required>
            </div>

            <div class="container-input">
                <label for="fecha_nacimiento">Fecha de Nacimiento <span>*</span></label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
            </div>

            <div class="container-input">
                <label for="no_telefono">Número de Teléfono <span>*</span></label>
                <input type="tel" id="no_telefono" name="no_telefono" value="{{ old('no_telefono') }}" required>
            </div>

            <div class="container-input">
                <label for="sexo">Sexo <span>*</span></label>
                <select id="sexo" name="sexo" required>
                    <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                    <option value="Prefiero no decirlo" {{ old('sexo') == 'Prefiero no decirlo' ? 'selected' : '' }}>Prefiero no decirlo</option>
                </select>
            </div>
        </div>

        <div class="container-section">
            <div class="container-input">
                <label for="direccion_fiscal">Dirección Fiscal</label>
                <input type="text" id="direccion_fiscal" name="direccion_fiscal" value="{{ old('direccion_fiscal') }}">
            </div>

            <div class="container-input">
                <label for="rfc">RFC</label>
                <input type="text" id="rfc" name="rfc" value="{{ old('rfc') }}">
            </div>

            <div class="container-input">
                <label for="email">Email <span>*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="container-input">
                <label for="password">Contraseña <span>*</span></label>
                <input type="password" id="password" name="password" required minlength="8">
            </div>

            <div class="container-input">
                <label for="password_confirmation">Confirmar Contraseña <span>*</span></label>
                <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8">
            </div>

            <button type="submit">Registrar Usuario</button>
        </div>
    </form>
</div>

<script>
    // JavaScript para cerrar los mensajes automáticamente
    document.addEventListener('DOMContentLoaded', function () {
        // Ocultar el mensaje de éxito después de 3 segundos
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(function () {
                successMessage.style.display = 'none'; // Oculta el mensaje
            }, 3000);
        }

        // Ocultar el mensaje de error después de 5 segundos
        var errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            setTimeout(function () {
                errorMessage.style.display = 'none'; // Oculta el mensaje
            }, 5000);
        }
    });
</script>

@endsection
