@extends('layouts.app')

@section('contenido')
<div class="container text-center mt-5">
    <h1 class="text-danger">Pago fallido</h1>
    <p>Lamentablemente, tu transacción no pudo completarse. Intenta nuevamente o contacta al soporte.</p>
    <a href="{{ route('carrito.index') }}" class="btn btn-primary">Volver al carrito</a>
</div>
@endsection
