@extends('layouts.app')

@section('titulo', 'Mis Pedidos')

@section('contenido')
    <div class="container">
        <center><h1 class="my-4">Mis Pedidos</h1></center>

        @if ($pedidos->isEmpty())
            <center><p>No tienes pedidos registrados.</p></center>
        @else
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Productos</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedidos as $pedido)
                        <tr>
                            <td>
                                <ul>
                                    @foreach (json_decode($pedido->productos, true) as $producto)
                                        <li>{{ $producto['name'] }} (x{{ $producto['quantity'] }})</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $pedido->estado }}</td>
                            <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

@section('styles')
    <style>
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            font-size: 2rem;
            font-weight: bold;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
        }

        table thead {
            background-color: #f8f9fa;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        ul li {
            margin-bottom: 5px;
        }
    </style>
@endsection
