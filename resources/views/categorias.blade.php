<!-- categorias.blade.php -->

@extends('layouts.app')
@section('titulo', 'Servicios') <!-- Establecer el título aquí -->

@section('contenido')

    <style>
        h1 {
            margin:24px 12px; 
            font-size: 32px; 
            font-weight: 700; 
            color: #033649;
        }

        .list-group-item:hover {
            background: #033649;
            color: #FFF;
        }
    </style>

    <h1>Listado de Categorías</h1>
        @foreach($categorias as $categoria)
            <a href="{{ route('productosPorCategoria', $categoria->id) }}" class="list-group-item list-group-item-action">{{ $categoria->nombre }}</a>
        @endforeach
@endsection