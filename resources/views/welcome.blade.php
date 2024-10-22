@extends('layouts.app')
@section('contenido')
<head>
    <title>INCIO DE SESION</title>
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
    <div class="container-login">
        <div class="container-login-left">
            <h1>INICIO DE SESIÓN</h1>
            <p>Nos alegra verte de nuevo</p>
            <form action="" method="POST">
                @csrf
                <input type="text" name="email" placeholder="Correo Electronico">
                <br>
                <input type="password" name="password" placeholder="Contraseña">
                <br>
                <input id="btn-enviar" type="submit" value="Enviar">
            </form>
        </div>
        <div class="container-login-right">
            <img src="/img/img-login.png" alt="Imagen login">
        </div>
    </div>
</body>

@endsection