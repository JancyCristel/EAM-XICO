@extends('layouts.app')

<link rel="stylesheet" href="/css/transacciones-detalles.css">

@section('contenido')
<br><br><br>
<div class = "container">
<div class="card">
    <div class="card-header">
        <h2>Información de la Transaccion</h2>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
        
                        <p>ID : {{$transa->id}}</p>
                        <p>Nombre Producto: {{ $transa->producto->nombre }}</p>
                        <p>Cantidad: {{ $transa->cantidad }}</p>
                        <p>Precio: {{ $transa->precio}}</p>
                        <p>Usuario: {{ $transa->usuario->name }}</p>
                        
                    </div>
                    <div class="col-md-6">
                        <p>Alta: {{ $transa->created_at }}</p>
                        <p id="text-categoria">{{ $transa->producto->categoria->nombre }}</p>
                    </div>
                    <p>{{$transa->voucher}}</p>
                    <img id="img-evidencia" src="{{ asset('/storage/evidencias/' . $transa->id . '.png') }}" class="img-thumbnail" alt="Voucher de la transacción" style="max-width: 200px;">
                </div>
            </div>
            <form action={{ route('transaccion', $transa->id) }} method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select class="form-control" id="estado" name="estado" required >
                        <option value="Rechazado" {{ $transa->estado === 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
                        <option value="Pendiente" {{ $transa->estado === 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="Aceptado" {{ $transa->estado === 'Aceptado' ? 'selected' : '' }}>Aceptado</option>
                    </select>
                    <button id="btn-guardar" type="submit" class="btn btn-primary">Guardar</button>
            </form>
    </div>
</div>
</div>
@endsection