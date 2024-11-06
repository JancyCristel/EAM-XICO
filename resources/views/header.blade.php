<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/header.css">
    <title>Energía Activa de México</title>
    <!-- Agregar Font Awesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header>
        <div class="header-container">
            <a href="/login2" class="header-logo">
                <img src="img/EA.png" class="logo">
            </a>
            <nav>
                <ul class="nav-menu">
                    <li><a href="/login2">Inicio</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">Servicios</a>
                        <ul class="dropdown-menu">
                            @foreach ($categorias as $categoria)
                                <li><a href="{{ route('productosPorCategoria', $categoria->id) }}">{{ $categoria->nombre }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="/listar-productos">Productos</a></li>
                    <li><a href="/serivicios">Servicios</a></li>
                    @auth
                    @if(auth()->user()->rol == 'Cliente')
                            <li><a href="/cliente">Mi perfil</a></li>
                        @endif
                        @if(auth()->user()->rol == 'Supervisor')
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle">Administrar</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('CrudSupervisorCategorias') }}">Categorías</a></li>
                                    <li><a href="{{ route('CrudSupervisorUsuarios') }}">Usuarios</a></li>
                                    <li><a href="{{ route('UsuariosVendedores') }}">Vendedores</a></li>
                                </ul>
                            </li>
                        @elseif(auth()->user()->rol == 'Encargado')
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle">Consignar</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('consignar') }}">Consignar</a></li>
                                    <li><a href="{{ route('desconsignar') }}">Desconsignar</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('ContraEncargadoVista') }}">Restablecer Contraseña</a></li>
                        @elseif(auth()->user()->rol == 'Vendedor')
                            <li><a href="{{ route('mProductos') }}">Mis Productos</a></li>
                            <li><a href="{{ route('mVentas') }}">Mis Ventas</a></li>
                            <li><a href="{{ route('crearProducto') }}">Crear Producto</a></li>
                        @elseif(auth()->user()->rol == 'Contador')
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle">Pagos</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('PagosIniciar') }}">Crear Pagos</a></li>
                                    <li><a href="{{ route('ListarPagos') }}">Listar Pagos</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('mostrarTransacciones') }}">Transacciones</a></li>
                        @endif
                    @endauth
                </ul>
            </nav>
            <!-- Iniciar sesión, cerrar sesión y registrarse a la derecha -->
            <nav>
                <ul class="nav-menu">
                    @auth
                        <li>
                            <a href="{{ route('carrito.index') }}" title="Ver Carrito">
                                <i class="fas fa-shopping-cart"></i>
                                Carrito
                                <span class="badge badge-light">
                                    {{ session('cart.totalItems', 0) }}
                                    <!-- Aquí se debería calcular desde el carrito en la sesión -->
                                </span>
                            </a>
                        </li>
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
    <script>
    // Función para actualizar el número de artículos en el icono del carrito
    function updateCartItemCount() {
        fetch('{{ route('cart.count') }}')
            .then(response => response.json())
            .then(data => {
                const cartCountElement = document.querySelector('.badge.badge-light');
                if (cartCountElement) {
                    cartCountElement.textContent = data.count;
                }
            });
    }

    // Llamar a la función para actualizar el número de artículos cada vez que se carga la página
    document.addEventListener('DOMContentLoaded', updateCartItemCount);

    // Refrescar el conteo al actualizar el carrito
    document.querySelectorAll('.btn-primary, .btn-danger').forEach(button => {
        button.addEventListener('click', function() {
            setTimeout(updateCartItemCount, 500); // Refresca el conteo después de actualizar el carrito
        });
    });
</script>

</body>

</html>

