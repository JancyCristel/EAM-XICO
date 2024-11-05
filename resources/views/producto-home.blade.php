@extends('layouts.app')
@section('titulo', 'Productos')

<link rel="stylesheet" href="/css/view-productos.css">

@section('contenido')
<div class="container">
    <h1>Listado de Productos</h1>
    <form action="{{ route('buscarProductos') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar producto..."
                value="{{ request('search') }}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>
    <div class="row">
        @foreach($consignas as $producto)
            @if($producto->estado == 'Aceptado')
                <div class="col-md-4">
                    <div class="card">
                        @if($producto->producto->fotos->count() > 0)
                            <ul>
                                @foreach ($producto->producto->fotos->all() as $foto)
                                    <li>
                                        <img src="{{ asset('storage/' . $foto->ruta) }}" alt="imagen-producto"
                                            style="max-width: 100px; max-height: 100px;" />
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div
                                style="width: 100%; height: 230px; display:flex; align-items: center; justify-content: center; padding:10px;">
                                <img src="{{ asset('/storage/fotos_productos/' . $producto->id . '.jpg') }}" class="card-img-top"
                                    alt="Imagen por defecto" style="width:auto; height: 100%; max-width:100%;">
                            </div>
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->producto->nombre }}</h5>
                            <p class="card-text">{{ $producto->producto->descripcion }}</p>
                            <p class="card-text">Stock: {{ $producto->producto->stock }}</p>
                            <p class="card-text">Categoria: {{ $producto->producto->categoria->nombre }}</p>
                            <p class="card-text">Precio: {{ $producto->producto->precio }}</p>

                            <a href="{{ route('detalles', $producto->id) }}" class="btn btn-primary">Ver Detalles</a>
                            @if (Auth::check())
                                @if (Auth::user()->rol == 'Cliente')
                                    <form action="{{ route('cart.add', $producto->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                                    </form>
                                   
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection