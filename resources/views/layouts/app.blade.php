<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Energía Activa de México')</title> <!-- Título dinámico -->
    <!-- CSS Link -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('header')
    <main>
        @yield('contenido')
    </main>

    @if(request()->is('login2')|| request()->is('/'))
        <footer>
            @include('footer')
        </footer>
    @endif
    @yield('scripts')

</body>

</html>
