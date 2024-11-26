@extends('layouts.app')

@section('contenido')
<div class="container">
    <h1 class="text-center mb-4">Seleccionar Dirección</h1>

    @if(session('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($addresses->isEmpty())
        <div class="text-center">
            <p>No tienes direcciones registradas.</p>
            <a href="{{ route('direccion.create') }}" class="btn btn-primary">Agregar Dirección</a>
        </div>
    @else
        <div class="row">
            @foreach($addresses as $address)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $address->nombre_recibe }}</h5>
                            <p class="card-text">
                                {{ $address->calle }} {{ $address->numero_casa }}, {{ $address->colonia }} <br>
                                {{ $address->municipio }}, {{ $address->estado }}, {{ $address->codigo_postal }} <br>
                                Referencias: {{ $address->referencias ?? 'Ninguna' }} <br>
                                Entre calles: {{ $address->entre_calles ?? 'Ninguna' }}<br>
                                {{ $address->phone_number }},
                            </p>
                            <a href="{{ route('stripe.index') }}" class="btn btn-success">Proceder al Pago</a>
                            <a href="{{ route('direccion.edit', $address->id) }}" class="btn btn-warning">Editar Dirección</a>
                            <form action="{{ route('direccion.destroy', $address->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar Dirección</button>
                            </form>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('direccion.create') }}" class="btn btn-secondary">Agregar Nueva Dirección</a>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var message = document.getElementById('success-message'); // Asegúrate de que coincida con el id del HTML
        if (message) {
            setTimeout(function () {
                message.style.display = 'none'; // Oculta el mensaje
            }, 3000); // 3 segundos
        }
    });
</script>
@endsection