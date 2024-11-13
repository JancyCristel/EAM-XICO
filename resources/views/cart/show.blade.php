@extends('layouts.app')
@section('titulo', 'Carrito de Compras') <!-- Establecer el título aquí -->
@section('contenido')
<div class="container">
    <h1>Carrito de Compras</h1>

    @if(session('success'))
        <div class="alert alert-success" id="success-message"> <!-- ID agregado aquí -->
            {{ session('success') }}
        </div>
    @endif

    @if(empty($cart))
        <p>Tu carrito está vacío.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalGeneral = 0; // Inicializar total general
                @endphp

                @foreach ($cart as $id => $item)
                    @if (is_array($item))
                        @php
                            $subtotal = $item['price'] * $item['quantity']; // Calcular subtotal para el producto
                            $totalGeneral += $subtotal; // Sumar al total general
                        @endphp
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>
                                <form action="{{ route('cart.update', $id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                        style="width: 60px;">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </form>
                            </td>
                            <td>${{ number_format($subtotal, 2) }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <h3>Total General: ${{ number_format($totalGeneral, 2) }}</h3>
    @endif
    <a href="{{ route('lista') }}" class="btn btn-secondary">Seguir comprando</a> <!-- Botón para volver a la sección de productos -->
    <a href="{{ route('pago') }}" class="btn btn-success">Continuar Compra</a>
</div>

@section('scripts')
<script>
    // JavaScript para cerrar el mensaje de éxito después de 3 segundos
    document.addEventListener('DOMContentLoaded', function () {
        var message = document.getElementById('success-message');
        if (message) {
            setTimeout(function () {
                message.style.display = 'none'; // Oculta el mensaje
            }, 3000);
        }
    });
</script>
@endsection

@endsection
