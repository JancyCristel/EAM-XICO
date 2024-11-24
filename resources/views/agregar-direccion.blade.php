@extends('layouts.app')

@section('contenido')
<div class="container">
    <h1 class="text-center mb-4">
        {{ isset($address) ? 'Editar Dirección' : 'Agregar Dirección' }}
    </h1>

    <form action="{{ isset($address) ? route('direccion.update', $address->id) : route('direccion.store') }}"
        method="POST">
        @csrf
        @if(isset($address))
            @method('PUT')
        @endif

        <div class="form-group mb-3">
            <label for="nombre_recibe">Nombre de quien recibe</label>
            <input type="text" name="nombre_recibe" id="nombre_recibe" class="form-control"
                value="{{ old('nombre_recibe', $address->nombre_recibe ?? '') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="phone_number">Número de Teléfono</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control"
                value="{{ old('phone_number', $address->phone_number ?? '') }}">
        </div>


        <div class="form-group mb-3">
            <label for="calle">Calle</label>
            <input type="text" name="calle" id="calle" class="form-control"
                value="{{ old('calle', $address->calle ?? '') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="numero_casa">Número de casa</label>
            <input type="text" name="numero_casa" id="numero_casa" class="form-control"
                value="{{ old('numero_casa', $address->numero_casa ?? '') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="colonia">Colonia</label>
            <input type="text" name="colonia" id="colonia" class="form-control"
                value="{{ old('colonia', $address->colonia ?? '') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="estado">Estado</label>
            <input type="text" name="estado" id="estado" class="form-control"
                value="{{ old('estado', $address->estado ?? '') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="municipio">Municipio</label>
            <input type="text" name="municipio" id="municipio" class="form-control"
                value="{{ old('municipio', $address->municipio ?? '') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="codigo_postal">Código Postal</label>
            <input type="text" name="codigo_postal" id="codigo_postal" class="form-control"
                value="{{ old('codigo_postal', $address->codigo_postal ?? '') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="referencias">Referencias</label>
            <textarea name="referencias" id="referencias"
                class="form-control">{{ old('referencias', $address->referencias ?? '') }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="entre_calles">Entre calles</label>
            <textarea name="entre_calles" id="entre_calles"
                class="form-control">{{ old('entre_calles', $address->entre_calles ?? '') }}</textarea>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">
                {{ isset($address) ? 'Actualizar Dirección' : 'Guardar Dirección' }}
            </button>
        </div>
    </form>
</div>
@endsection