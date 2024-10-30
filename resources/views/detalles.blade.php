
@extends('layouts.app')
@section('titulo', 'Detalles del Producto') <!-- Establecer el título aquí -->

<link rel="stylesheet" href="/css/detalle-producto.css">

@section('contenido')

<body>
    <div class="container">
        <h1>Detalles del Producto</h1>
        <div class="card">
            <img src="{{ asset('/storage/fotos_productos/' . $producto->id . '.jpg') }}" class="card-img-top" alt="{{ $producto->nombre }}">
            <div class="card-body">
                <h5 class="card-title">{{ $producto->nombre }}</h5>
                <p class="card-text">{{ $producto->descripcion }}</p>
                <p class="card-text">Stock: {{ $producto->stock }}</p>
                <p id="text-categoria" class="card-text">{{ $producto->categoria->nombre }}</p>
                <p class="card-text">Usuario: {{ $producto->user->name }}</p>
            </div>
        </div>

        @if (Auth::check())
            @if (Auth::user()->rol == 'Cliente')
                <a id="btn-comprar" href="{{ route('subirEvidencia', $producto->id) }}" class="btn btn-primary">Comprar</a>
            @endif
        @endif

        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Preguntas y Respuestas</h5>

                @if ($producto->preguntas->isEmpty())
                    <p>No hay preguntas ni respuestas.</p>
                @else
                    @foreach ($producto->preguntas as $pregunta)
                        <h3>{{ $pregunta->contenido }}</h3>
                        <p>Pregunta realizada por: {{ $pregunta->user->name ?? 'Usuario Anónimo' }}</p>

                        @foreach ($pregunta->respuestas as $respuesta)
                            <li>{{ $respuesta->contenido }}</li>
                            <p>Respuesta de: {{ $respuesta->usuario->name ?? 'Usuario Anónimo' }}</p>
                        @endforeach

                        @if (Auth::check() && $producto->user->id == auth()->user()->id)
                            <form action="{{ route('responderPregunta', $producto->id) }}" method="POST">
                                @csrf
                                <div class="form-group" id="mensajeField">
                                    <label for="mensaje">Responder</label>
                                    <textarea class="form-control" id="mensaje" name="contenido"></textarea><br>
                                    <button id="btn-responder" type="submit" class="btn btn-primary">Responder</button><br>
                                </div>
                            </form>
                        @endif
                    @endforeach
                @endif

                @if (Auth::check() && Auth::user()->rol == 'Cliente')
                    <form action="{{ route('hacerPregunta', $producto->id) }}" method="POST">
                        @csrf
                        <div class="form-group" id="mensajeField">
                            <label for="mensaje">Pregunta</label>
                            <textarea class="form-control" id="mensaje" name="contenido"></textarea>
                            <button id="btn-guardar" type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>

    </div>

    <!-- Incluir Bootstrap JS y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

@endsection
