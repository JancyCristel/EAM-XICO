@extends('layouts.app')
@section('contenido')

<body>
    <br><br><br>
    <div class="container">
        <h1>Listado de Productos</h1>
        <br><br>
        <a href="/productos-vendedor">Entrar a CRUD</a>
        <div class="row">

            @foreach($consignas as $producto)

                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ $producto->imagen }}" class="card-img-top" alt="{{ $producto->nombre }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->producto->nombre }}</h5>
                            <p class="card-text">{{ $producto->producto->descripcion }}</p>
                            <p class="card-text">Stock: {{ $producto->producto->stock }}</p>
                            <p class="card-text">Categoria: {{ $producto->producto->categoria->nombre }}</p>
                            <p class="card-text">Usuario: {{ $producto->producto->user->name }}</p>
                            <p class="card-text">Estado: {{ $producto->estado }}</p>
                            @if($producto->estado == 'Aceptado')
                                <a href="{{ route('detalles', $producto->producto->id) }}" class="btn btn-primary">VerDetalles</a>
                        
                            @endif


                        </div>
                    </div>
                </div>

            @endforeach

        </div>

        <!-- Incluir Bootstrap JS y jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
@endsection