@extends('layouts.app')
@section('titulo', 'Resumen') <!-- Establecer el título aquí -->
@section('contenido')
<div class="container">
    

    @if(empty($cart))
        <p>No hay productos en el carrito para proceder con el pago.</p>
    @else
        <h3>Resumen del Pedido</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Total a Pagar: ${{ number_format($total, 2) }}</h3>

        
            @csrf
            <!-- Campos de pago -->
            <button type="submit" class="btn btn-success">Elegir Direccion de Envío</button>
        </form>
    @endif
</div>
@endsection
