@extends('layouts.app')
@section('contenido')
    <div class="container">
        <br><br>
    <h1>Editar Usuario</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(auth()->user()->rol == 'Cliente')
    <form action="{{ route('UpdateUsuario', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="apellido_paterno">Apellido Paterno</label>
            <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" value="{{ $user->apellido_paterno }}" required>
        </div>
        <div class="form-group">
            <label for="apellido_materno">Apellido Materno</label>
            <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" value="{{ $user->apellido_materno }}" required>
        </div>
        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ $user->fecha_nacimiento }}" required>
        </div>
        <div class="form-group">
            <label for="no_telefono">Teléfono</label>
            <input type="text" class="form-control" id="no_telefono" name="no_telefono" value="{{ $user->no_telefono }}" required>
        </div>
        <div class="form-group">
            <label for="sexo">Sexo</label>
            <select class="form-control" id="sexo" name="sexo" required>
                <option value="Masculino" {{ $user->sexo === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="Femenino" {{ $user->sexo === 'Femenino' ? 'selected' : '' }}>Femenino</option>
            </select>
        </div>
        <!-- Dirección de Envío -->
        <div class="form-group">
            <label for="direccion_envio">Dirección de Envío</label>
            <textarea class="form-control" id="direccion_envio" name="direccion_envio">{{ $user->direccion_envio }}</textarea>
        </div>

        <!-- Dirección Fiscal -->
        <div class="form-group">
            <label for="direccion_fiscal">Dirección Fiscal</label>
            <textarea class="form-control" id="direccion_fiscal" name="direccion_fiscal">{{ $user->direccion_fiscal }}</textarea>
        </div>
        <div class="form-group">
            <label for="email">Correo Electronico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email}}" required>
        </div>
        <h1>Restablecer Contraseña</h1>
        <div class="form-group">
            <label for="password">Nueva Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>

    @elseif(auth()->user()->rol == 'Encargado')
    <form action="{{ route('UpdateUsuario', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required  readonly>
        </div>
        <div class="form-group">
            <label for="apellido_paterno">Apellido Paterno</label>
            <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" value="{{ $user->apellido_paterno }}" required readonly> 
        </div>
        <div class="form-group">
            <label for="apellido_materno">Apellido Materno</label>
            <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" value="{{ $user->apellido_materno }}" required readonly>
        </div>
        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ $user->fecha_nacimiento }}" required readonly>
        </div>
        <div class="form-group">
            <label for="no_telefono">Teléfono</label>
            <input type="text" class="form-control" id="no_telefono" name="no_telefono" value="{{ $user->no_telefono }}" required readonly>
        </div>
        <div class="form-group">
            <label for="sexo">Sexo</label>
            <input type="text" class="form-control" name="sexo" value="{{$user->sexo}}" readonly>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <textarea class="form-control" id="direccion" name="direccion" required readonly>{{ $user->direccion }}</textarea>
        </div>
        <div class="form-group">
            <label for="rol">Rol</label>
            <input type="text" name="rol" value="{{$user->rol}}" readonly class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Correo Electronico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email}}" required readonly>
        </div>
        <h1>Restablecer Contraseña</h1>
        <div class="form-group">
            <label for="password">Nueva Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
    @endif
    </div>
@endsection




