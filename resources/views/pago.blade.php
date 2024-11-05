@extends('layouts.app')

@section('content')
    <h1>Resumen del Pago</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carrito as $item)
                <tr>
                    <td>{{ $item['nombre'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>${{ $item['price'] }}</td>
                    <td>${{ $item['price'] * $item['quantity'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total a Pagar: ${{ $total }}</h3>
    <a href="{{ route('cart.show') }}" class="btn btn-secondary">Volver al Carrito</a>
    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Proceder con el Pago</button>
    </form>
@endsection




