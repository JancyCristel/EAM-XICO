@extends('layouts.app')

@section('contenido')
    <div class="container">
        <h1>Editar Producto</h1>
        <form action="{{ route('productosActualizar', $producto->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $producto->nombre }}">
            </div>
            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" value="{{ $producto->precio }}">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ $producto->descripcion }}</textarea>
            </div>
            <div class="form-group">
                <label for="fotos">Fotos</label>
                @foreach($producto->fotos as $foto)
    <div class="mb-2">
        <img src="{{ asset('storage/' . $foto->ruta) }}" class="img-thumbnail" alt="Foto del producto" style="max-width: 80px; max-height: 80px;">
        <form action="{{ route('eliminarFoto', $foto->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Eliminar Foto</button>
        </form>
    </div>
@endforeach

            </div>
            <div class="form-group">
                <label for="foto">Agregar más Fotos</label>
                <input type="file" class="form-control-file" id="foto" name="foto[]" multiple>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
@endsection


