<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/header.css">
    <title>Energía Activa de México</title>
</head>

<body>
    <header>
        <div class="header-container">
            <a href="/login2" class="header-logo">
                <img src="img\EA.png"  class="logo">
            </a>
            <nav>
                <ul class="nav-menu">
                    <li><a href="/login2">Inicio</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">Servicios</a>
                        <ul class="dropdown-menu">
                            @foreach ($categorias as $categoria)
                                <li><a
                                        href="{{ route('productosPorCategoria', $categoria->id) }}">{{ $categoria->nombre }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="/listar-productos">Productos</a></li>
                    @auth
                        @if(auth()->user()->rol == 'Supervisor')
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle">Administrar</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{route('CrudSupervisorCategorias')}}">Categorías</a></li>
                                    <li><a href="{{route('CrudSupervisorUsuarios')}}">Usuarios</a></li>
                                    <li><a href="{{route('UsuariosVendedores')}}">Vendedores</a></li>
                                </ul>
                            </li>
                        @elseif(auth()->user()->rol == 'Encargado')
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle">Consignar</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{route('consignar')}}">Consignar</a></li>
                                    <li><a href="{{route('desconsignar')}}">Desconsignar</a></li>
                                </ul>
                            </li>
                            <li><a href="{{route('ContraEncargadoVista')}}">Restablecer Contraseña</a></li>
                        @elseif(auth()->user()->rol == 'Vendedor')
                            <li><a href="{{route('mProductos')}}">Mis Productos</a></li>
                            <li><a href="{{route('mVentas')}}">Mis Ventas</a></li>
                            <li><a href="{{route('crearProducto')}}">Crear Producto</a></li>
                        @elseif(auth()->user()->rol == 'Contador')
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle">Pagos</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{route('PagosIniciar')}}">Crear Pagos</a></li>
                                    <li><a href="{{route('ListarPagos')}}">Listar Pagos</a></li>
                                </ul>
                            </li>
                            <li><a href="{{route('mostrarTransacciones')}}">Transacciones</a></li>
                        @endif
                    @endauth
                </ul>
            </nav>
            <!-- Iniciar sesión, cerrar sesión y registrarse a la derecha -->
            <nav>
                <ul class="nav-menu">
                    @auth
                        <li><a href="{{ route('login.out') }}">Cerrar sesión</a></li>
                    @else
                        <li><a href="{{ route('login.store') }}">Iniciar sesión</a></li>
                        <li id="btn-sesion"><a href="{{ route('user.register') }}">Registrarse</a></li>
                    @endauth
                </ul>
            </nav>
        </div>
    </header>

    <script>
        // JavaScript para manejar el menú desplegable
        document.querySelectorAll('.dropdown-toggle').forEach(function (toggle) {
            toggle.addEventListener('click', function (e) {
                e.preventDefault(); // Evitar que el enlace realice su acción por defecto
                const dropdown = this.nextElementSibling; // Obtener el menú desplegable
                dropdown.classList.toggle('open'); // Alternar la clase 'open' para mostrar/ocultar el menú
            });
        });

        // Cerrar el menú al hacer clic fuera de él
        window.addEventListener('click', function (e) {
            document.querySelectorAll('.dropdown-menu').forEach(function (menu) {
                if (!menu.parentElement.contains(e.target)) {
                    menu.classList.remove('open'); // Remover la clase 'open' si se hace clic fuera
                }
            });
        });
    </script>
</body>

</html>