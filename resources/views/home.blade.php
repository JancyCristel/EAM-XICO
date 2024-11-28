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
        <p>Somos Integradores de servicios tecnológicos que ayudamos a lograr más, estableciendo relaciones de
            ganar-ganar. Respaldados por marcas líderes en seguridad, control de acceso, automatización, cómputo,
            mobiliario y energías alternas.</p>
    </div>
    <div class="image-container">
        <img src="img/img-banner.png" alt="Icono de Energía Activa">
    </div>
</section>

<!-- Sección Nuestro Compromiso -->
<section id="nuestro-compromiso" class="section-background reverse">
    <div class="text-container">
        <h2>Nuestro Compromiso</h2>
        <p>En Energía Activa de México implementamos proyectos que amplían el desarrollo de personas, empresas y
            comunidades, mejorando su calidad de vida y solucionando problemas para que alcancen sus metas.</p>
    </div>
    <div class="image-container">
        <img src="img/compromiso.jpg" alt="Imagen de Nuestro Compromiso">
    </div>
</section>

<!-- Sección Servicios Tecnológicos -->
<section id="servicios" class="section-background">
    <!-- Título centrado -->
    <h2 class="titulo-servicios">Servicios Tecnológicos Integrados</h2>
    
    <!-- Texto adicional debajo del título -->
    <p class="descripcion-servicios">Dimensionamiento de proyectos, venta de productos, instalación de equipos, asesoría y mantenimiento.</p>
    
    <div class="services-gallery">
        <!-- Primer servicio -->
        <div class="service-item">
            <img src="img/auto.jpg" alt="Automatización y Control">
            <p><strong>Automatización y Control</strong><br>
            Implementamos soluciones de automatización y control de acceso para el mejor manejo de tu negocio, empresa u hogar.</p>
        </div>

        <!-- Segundo servicio -->
        <div class="service-item">
            <img src="img/luces.avif" alt="Energías Alternas">
            <p><strong>Energías Alternas</strong><br>
            Ofrecemos soluciones en energías alternas para solucionar problemas y mejorar la calidad de vida de las personas.</p>
        </div>

        <!-- Tercer servicio -->
        <div class="service-item">
            <img src="img/seguridad.avif" alt="Seguridad y Vigilancia">
            <p><strong>Seguridad y Vigilancia</strong><br>
            Tenemos el sistema de seguridad y vigilancia que más se adapte a tus necesidades. Vigila y protege lo más valioso para ti.</p>
        </div>

         <!-- Cuarto servicio -->
         <div class="service-item">
            <img src="img/computo.avif" alt="Cómputo y mobiliario">
            <p><strong>Cómputo y mobiliario</strong><br>
            Tenemos la solución y soporte en equipo de cómputo y mobiliario para tu casa, negocio o empresa.</p>
        </div>
    </div>
</section>


<!-- Sección Capacidad y Experiencia en el Mercado -->
<section class="section-background">
    <div class="text-container">
        <h2>Capacidad y Experiencia en el Mercado</h2>
        <p>Integramos productos para que hagas más</p>
    </div>
    <div class="image-container">
        <div class="photo-grid">
            <img src="img/cap1.webp" alt="Experiencia 1">
            <img src="img/cap2.webp" alt="Experiencia 2">
            <img src="img/cap3.webp" alt="Experiencia 3">
            <img src="img/cap4.webp" alt="Experiencia 4">
        </div>
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
                                <li>Apellido: {{ $UltimoUsuarioRegistrado->apellido_paterno }}
                                    {{ $UltimoUsuarioRegistrado->apellido_materno }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="card col-md-6">
                    <div class="card-header">
                        <h4>
                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                data-target="#transaccionesCollapse" aria-expanded="true" aria-controls="transaccionesCollapse">
                                Transacciones
                            </button>
                        </h4>
                    </div>
                    <div id="transaccionesCollapse" class="collapse show" aria-labelledby="headingOne"
                        data-parent="#accordionExample">
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
                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                data-target="#productosNoConsignadosCollapse" aria-expanded="true"
                                aria-controls="productosNoConsignadosCollapse">
                                Productos no consignados
                            </button>
                        </h4>
                    </div>
                    <div id="productosNoConsignadosCollapse" class="collapse show" aria-labelledby="headingOne"
                        data-parent="#accordionExample">
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
<script>
    // JavaScript para el desplazamiento suave entre secciones
    document.querySelectorAll('.nav-links a').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    document.querySelector('.btn-vermas').addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector('#sobre-nosotros').scrollIntoView({
            behavior: 'smooth'
        });
    });
</script>
<script>
    // JavaScript para el desplazamiento suave entre secciones
    document.querySelectorAll('.nav-links a').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    document.querySelector('.btn-vermas2').addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector('#nuestro-compromiso').scrollIntoView({
            behavior: 'smooth'
        });
    });
</script>
@endsection
