@extends('layouts.app')

@section('contenido')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Servicios</title>
</head>
<body>
    <h1>Servicios</h1>
    <ul>
        @foreach ($servicios as $servicio)
            <li>{{ $servicio->nombre }} - {{ $servicio->descripcion }}</li>
        @endforeach
    </ul>
</body>
</html>
@endsection
