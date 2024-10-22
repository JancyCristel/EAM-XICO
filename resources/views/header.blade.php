<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/header.css">
</head>

<body>
    <header>
        
        <div class="header-container">
            <div class="header-title"></div>
            <nav>
                <ul class="nav-menu">
                    <li><a href="/login2">Inicio</a></li>
                    <li class="dropdown">
                        <a href={{route('ShowCategorias')}}>Servicios</a>
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
                                <a href='#'>Administrar</a>
                                <ul class="dropdown-menu">
                                    <li><a href={{route('CrudSupervisorCategorias')}}> Categorias </a></li>
                                    <li><a href={{route('CrudSupervisorUsuarios')}}>Usuarios</a></li>
                                    <li><a href={{route('UsuariosVendedores')}}>Vendedores</a></li>
                                </ul>
                            </li>

                        @elseif(auth()->user()->rol == 'Encargado')
                            <li class="dropdown">
                                <a href='#'>Consignar</a>
                                <ul class="dropdown-menu">
                                    <li><a href={{route('consignar')}}> Consignar </a></li>
                                    <li><a href={{route('desconsignar')}}> Desconsignar</a></li>

                                </ul>
                            </li>

                            <li><a href={{route('ContraEncargadoVista')}}>Restablecer Contraseña</a></li>


                        @elseif(auth()->user()->rol == 'Vendedor')
                            <li><a href={{route('mProductos')}}>Mis Productos</a></li>
                            <li><a href={{route('mVentas')}}>Mis Ventas</a></li>
                            <li><a href={{route('crearProducto')}}>Crear Producto</a></li>


                        @elseif(auth()->user()->rol == 'Contador')
                            <li class="dropdown">
                                <a href='#'>Pagos</a>
                                <ul class="dropdown-menu">
                                    <li><a href={{route('PagosIniciar')}}> Crear Pagos </a></li>
                                    <li><a href={{route('ListarPagos')}}> Listar Pagos</a></li>

                                </ul>
                            <li><a href={{route('mostrarTransacciones')}}>Transacciones</a></li>


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
</body>

</html>