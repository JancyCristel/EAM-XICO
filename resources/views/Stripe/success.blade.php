@extends('layouts.app')

@section('contenido')
<div class="container text-center mt-5">
    <h1 class="text-success">¡Pago exitoso!</h1>
    <p>Gracias por tu compra. Tu transacción se completó correctamente.</p>
    <a href="{{ route('carrito.index') }}" class="btn btn-primary">Volver al inicio</a>
</div>
@endsection
