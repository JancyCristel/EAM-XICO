@extends('layouts.app')

@section('contenido')
<div class="container">
<h1>Lista de los productos que le pertenecen</h1>
<div>
    <a href="{{ route('crearProducto') }}" class="btn btn-primary">Crear Nueva Propuesta</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Stock</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Imágenes</th>
            <th>Consignas</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->categoria->nombre }}</td>
                <td>{{ $producto->stock }}</td>
                <td>{{ $producto->descripcion }}</td>
                <td>{{ $producto->precio }}</td>
                <td>
                    <ul>
                        @foreach ($producto->fotos as $foto)
                            <li>
                            <img src="{{ asset('storage/fotos_productos/' . $producto->id . '.png') }}" alt="imagen-producto" style="max-width: 50px; max-height: 50px;"/>

                            </li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <ul>
                        @foreach ($producto->consignas as $consigna)
                            <li>
                                {{ $consigna->estado }}
                                {{ $consigna->mensaje }}
                            </li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    @if ($producto->consignas->contains('estado', 'Pendiente') || $producto->consignas->contains('estado', 'Rechazado'))
                    <a href="{{ route('productosEditar', $producto->id) }}" class="btn btn-primary">Editar Producto</a>    
                    <form action="{{ route('eliminarProducto', $producto->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar Producto</button>
                        </form>
                        <form action="{{ route('SubirFoto', $producto->id) }}" method="POST" enctype="multipart/form-data" style="display: inline;">
                            @csrf
                            <div class="form-group">
                                <input type="file" class="form-control-file" id="foto" name="foto">
                            </div>
                            <button type="submit" class="btn btn-primary">Subir Foto</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>



@endsection



