@extends('layouts.app')
@section('titulo', 'Perfil de Usuario') <!-- Establecer el título aquí -->
@section('contenido')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}"> <!-- Enlace al CSS específico -->
    <title>Mi Perfil</title>
</head>
<body>
    <h1>Mi Perfil</h1>

    <div class="profile-info">
        <p><strong>Nombre:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Apellido Paterno:</strong> {{ Auth::user()->apellido_paterno }}</p>
        <p><strong>Apellido Materno:</strong> {{ Auth::user()->apellido_materno }}</p>
        <p><strong>Fecha de Nacimiento:</strong> {{ Auth::user()->fecha_nacimiento }}</p>
        <p><strong>Teléfono:</strong> {{ Auth::user()->no_telefono }}</p>
        <p><strong>Sexo:</strong> {{ Auth::user()->sexo }}</p>
        <p><strong>Dirección de Envío:</strong> {{ Auth::user()->direccion_envio }}</p>
        <p><strong>Dirección Fiscal:</strong> {{ Auth::user()->direccion_fiscal }}</p>
        <p><strong>Referencias:</strong> {{ Auth::user()->referencias }}</p>
        <p><strong>RFC:</strong> {{ Auth::user()->rfc }}</p>
        <p><strong>Rol:</strong> {{ Auth::user()->rol }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
    </div>

    <div class="edit-button">
    <a href="{{ route('EditUsuario', ['id' => Auth::user()->id]) }}" class="btn btn-primary">Editar Perfil</a>
</div>
</body>
</html>

@endsection