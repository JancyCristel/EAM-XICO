@extends('layouts.app')

<link rel="stylesheet" href="/css/home-incognito.css">

@section('contenido')
    <!-- Sección Principal (Hero) -->
    <header class="hero">
        <h1>Energía Activa de México</h1>
        <p>Intégrate al futuro</p>
        <a href="#sobre-nosotros" class="btn-vermas">Ver Más</a>
    </header>

    <!-- Sección Sobre Nosotros -->
    <section id="sobre-nosotros" class="section-background">
        <div class="text-container">
            <h2>Energía Activa de México</h2>
            <p>Somos Integradores de servicios tecnológicos que ayudamos a lograr más, estableciendo relaciones de ganar-ganar. Respaldados por marcas líderes en seguridad, control de acceso, automatización, cómputo, mobiliario y energías alternas.</p>
            <a href="#nuestro-compromiso" class="btn-vermas2">Ver Más</a>
        </div>
        <div class="image-container">
            <img src="icono.jpg" alt="Icono de Energía Activa">
        </div>
    </section>

    <!-- Sección Nuestro Compromiso -->
    <section id="nuestro-compromiso" class="section-background reverse">
        <div class="text-container">
            <h2>Nuestro Compromiso</h2>
            <p>En Energía Activa de México implementamos proyectos que amplían el desarrollo de personas, empresas y comunidades, mejorando su calidad de vida y solucionando problemas para que alcancen sus metas.</p>
        </div>
        <div class="image-container">
            <img src="nosotros.jpg" alt="Imagen de Nuestro Compromiso">
        </div>
    </section>

    <!-- Sección Servicios Tecnológicos -->
    <section id="servicios" class="section-background">
        <h2>Servicios Tecnológicos</h2>
        <p>Ofrecemos una gama de servicios tecnológicos adaptados a tus necesidades.</p>
        <div class="services-gallery">
            <div class="service-item">
                <img src="service1.jpg" alt="Servicio 1">
                <p>Descripción breve del servicio 1</p>
            </div>
            <div class="service-item">
                <img src="service2.jpg" alt="Servicio 2">
                <p>Descripción breve del servicio 2</p>
            </div>
            <!-- Agrega más servicios según sea necesario -->
        </div>
    </section>

    <!-- Sección Capacidad y Experiencia en el Mercado -->
    <section id="capacidad-experiencia" class="section-background">
        <h2>Capacidad y Experiencia en el Mercado</h2>
        <div class="photo-carousel">
            <img src="producto1.avif" alt="Experiencia 1">
            <img src="panel.avif" alt="Experiencia 2">
            <!-- Agrega más fotos según sea necesario -->
        </div>
    </section>

    @if(auth()->check())
        @if(auth()->user()->rol == 'Supervisor')
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Cantidad de usuarios</h4>
                            </div>
                            <div class="card-body">
                                <p>{{ $CantidadUsuarios }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Último usuario registrado</h4>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li>ID: {{ $UltimoUsuarioRegistrado->id }}</li>
                                    <li>Nombre: {{ $UltimoUsuarioRegistrado->name }}</li>
                                    <li>Apellido: {{ $UltimoUsuarioRegistrado->apellido_paterno }} {{ $UltimoUsuarioRegistrado->apellido_materno }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="card col-md-6">
                        <div class="card-header">
                            <h4>
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#transaccionesCollapse" aria-expanded="true" aria-controls="transaccionesCollapse">
                                    Transacciones
                                </button>
                            </h4>
                        </div>
                        <div id="transaccionesCollapse" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Producto</th>
                                                <th>Descripción</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Usuario</th>
                                                <th>Alta</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Transacciones as $transaccion)
                                                <tr>
                                                    <td>{{ $transaccion->id }}</td>
                                                    <td>{{ $transaccion->producto->nombre }}</td>
                                                    <td>{{ $transaccion->producto->descripcion }}</td>
                                                    <td>{{ $transaccion->cantidad }}</td>
                                                    <td>{{ $transaccion->precio }}</td>
                                                    <td>{{ $transaccion->usuario->name }}</td>
                                                    <td>{{ $transaccion->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card col-md-6">
                        <div class="card-header">
                            <h4>
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#productosNoConsignadosCollapse" aria-expanded="true" aria-controls="productosNoConsignadosCollapse">
                                    Productos no consignados
                                </button>
                            </h4>
                        </div>
                        <div id="productosNoConsignadosCollapse" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Producto</th>
                                                <th>Descripción</th>
                                                <th>Stock</th>
                                                <th>Usuario</th>
                                                <th>Alta</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ProductosNConsignados as $producto)
                                                <tr>
                                                    <td>{{ $producto->id }}</td>
                                                    <td>{{ $producto->producto->nombre }}</td>
                                                    <td>{{ $producto->producto->descripcion }}</td>
                                                    <td>{{ $producto->producto->stock }}</td>
                                                    <td>{{ $producto->producto->user->name }}</td>
                                                    <td>{{ $producto->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
@endsection


