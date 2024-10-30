@extends('layouts.app')

<link rel="stylesheet" href="/css/home-incognito.css">

@section('contenido')
    <div class="container">
        <br><br>
        <img class="banner-web" src="/img/banner-web-1.png" alt="Banner">
        <div class="container-text">
            <div class="container-text-left">
                <h1>Bienvenido</h1>
                <p>En Techtopia, estamos comprometidos a brindarte lo último en tecnología y soluciones innovadoras. Nuestro objetivo es proporcionarte productos de calidad que mejoren tu vida diaria y te mantengan al día con las últimas tendencias tecnológicas.</p>
                <p>Explora nuestra amplia gama de productos, desde dispositivos móviles y equipos informáticos hasta gadgets inteligentes y accesorios de vanguardia. Con marcas líderes y productos de alta calidad, estamos seguros de que encontrarás lo que necesitas en Techtopia.</p>
                <p>Además de ofrecerte productos excepcionales, también nos esforzamos por brindarte la mejor experiencia de compra. Nuestro equipo está aquí para ayudarte en cada paso del camino, desde encontrar el producto perfecto hasta asegurarte de que tu compra sea sin problemas.</p>
                <p>Únete a la revolución tecnológica en Techtopia y descubre un mundo de posibilidades tecnológicas emocionantes. ¡Gracias por visitarnos y esperamos verte pronto!</p>
            </div>
            <div class="container-text-right">
                <img src="/img/img-banner.png" alt="Promociones">
            </div>
        </div>

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
    </div>
@endsection

