@extends('layouts.app')
<link rel="stylesheet" href="/css/create-categorias.css">
@section('contenido')


    <div class="container">
        <h1>Crear Categoría</h1>
        <form action="{{ route('StoreCategorias') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <button id="btn-guardar" type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>

@endsection


