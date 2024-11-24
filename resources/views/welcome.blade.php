@extends('layouts.app')
@section('titulo', 'Inicio de sesión') <!-- Establecer el título aquí -->
@section('contenido')

<head>
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>
    @if(session('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container-login">
        <div class="container-login-left">
            <h1>INICIO DE SESIÓN</h1>
            <p>Nos alegra verte de nuevo</p>

            <!-- Mostrar el mensaje de error -->
            @if($errors->any())
                <div id="error-message" class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login.store') }}" method="POST">
                @csrf
                <input type="text" name="email" placeholder="Correo Electrónico" required>
                <br>
                <input type="password" name="password" placeholder="Contraseña" required>
                <br>
                <input id="btn-enviar" type="submit" value="Enviar">
            </form>
        </div>
        <div class="container-login-right">
            <img src="/img/img-login.png" alt="Imagen login">
        </div>
    </div>

    <!-- JavaScript para cerrar el mensaje de error después de 3 segundos -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var message = document.getElementById('error-message');
            if (message) {
                setTimeout(function () {
                    message.style.display = 'none'; // Oculta el mensaje
                }, 3000);
            }
        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var message = document.getElementById('success-message');
        if (message) {
            setTimeout(function () {
                message.style.display = 'none'; // Oculta el mensaje
            }, 3000);
        }
    });
</script>



</body>
@endsection