@extends('layouts.app')
@section('titulo', 'Servicios') <!-- Establecer el título aquí -->
@section('contenido')
    <h1>Servicios</h1>
    <ul>
        @foreach ($servicios as $servicio)
            <li>{{ $servicio->nombre }} - {{ $servicio->descripcion }}</li>
        @endforeach
    </ul>
@endsection


