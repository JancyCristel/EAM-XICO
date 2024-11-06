<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Models\Producto;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Transaccion;
use App\Models\Pago;
use App\Models\Consiga;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{

    public function index()
    {
        $usuarios = User::all(); // Obtener todos los usuarios
        $categorias = Categoria::all(); // Obtener todas las categorías

        if (auth()->user()->rol == 'Supervisor') {
            return view('CrudSupervisorUsuarios', compact('usuarios'));
        } elseif (auth()->user()->rol == 'Contador') {
            $vendedores = Producto::whereHas('transacciones', function ($query) {
                $query->where('estado', 'aceptado')->whereNotIn('id', function ($subquery) {
                    $subquery->select('idTransaccion')->from('pagos');
                });
            })->pluck('idUser')->unique();

            $usuarios = User::whereIn('id', $vendedores)->where('rol', 'Vendedor')->get();
            return view('contadorIniciarPago', compact('usuarios'));
        }
    }

    public function indexVendor()
    {
        $usuarios = User::all(); // Obtener todos los usuarios
        $categorias = Categoria::all(); // Obtener todas las categorías
        return view('CrudSupervioserVendedores', compact('usuarios'));
    }


    public function create()
    {
        return view('CreateUsuario');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'no_telefono' => 'required|integer',
            'sexo' => 'required|in:Masculino,Femenino,Prefiero no decirlo',
            'direccion' => 'required|string|max:255',
            'rol' => 'required|in:Encargado,Cliente,Contador,Supervisor,Vendedor',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->apellido_paterno = $request->apellido_paterno;
        $user->apellido_materno = $request->apellido_materno;
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->no_telefono = $request->no_telefono;
        $user->sexo = $request->sexo;
        $user->direccion = $request->direccion;
        $user->rol = $request->rol;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message' => 'Usuario creado correctamente.',
            'user' => $user,
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('EditUsuarios', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validación de los datos
    $request->validate([
        'name' => 'required|string|max:255',
        'apellido_paterno' => 'required|string|max:255',
        'apellido_materno' => 'required|string|max:255',
        'fecha_nacimiento' => 'required|date',
        'no_telefono' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$id,
        'sexo' => 'required|in:Masculino,Femenino,Prefiero no decirlo',
        'direccion_envio' => 'required|string|max:255', // Nueva validación para dirección de envío
        'direccion_fiscal' => 'required|string|max:255', // Nueva validación para dirección fiscal
        'password' => 'nullable|string|min:8', // La contraseña es opcional, pero debe tener al menos 8 caracteres si se proporciona
    ]);

    // Encontrar el usuario por ID
    $user = User::find($id);
    $user->name = $request->name;
    $user->apellido_paterno = $request->apellido_paterno;
    $user->apellido_materno = $request->apellido_materno;
    $user->fecha_nacimiento = $request->fecha_nacimiento;
    $user->no_telefono = $request->no_telefono;
    $user->email = $request->email;
    $user->sexo = $request->sexo;
    $user->direccion_envio = $request->direccion_envio; // Asignar dirección de envío
    $user->direccion_fiscal = $request->direccion_fiscal; // Asignar dirección fiscal
    $user->rol = 'Cliente'; // Asignar el rol como "Cliente" siempre

    // Solo actualizar la contraseña si se proporciona una nueva
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();
    return redirect('/cliente')->with('success', 'Datos actualizados');

    // Redireccionar según el rol actual del usuario autenticado
    if (auth()->user()->rol == "Supervisor") {
        return redirect()->route('CrudSupervisorUsuarios')->with('success', 'Usuario actualizado correctamente.');
    } elseif (auth()->user()->rol == "Encargado") {
        return redirect()->route('ContraEncargadoVista')->with('success', 'Usuario actualizado correctamente.');
    }
}




    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return redirect()->route('CrudSupervisorUsuarios')->with('success', 'Usuario eliminado correctamente.');
    }


    public function detalleVendor($id)
    {
        $vendedor = User::findOrFail($id);
        $productos = $vendedor->productos()->get();
        $cantidadProductosEnVenta = $productos->count();

        $idsProductos = $productos->pluck('id')->toArray();

        // Filtrar las transacciones por los IDs de los productos del vendedor
        $transa = Transaccion::whereIn('idProducto', $idsProductos)
            ->where('estado', 'Aceptado')
            ->get();
        $cantidadTransacciones = $transa->count();
        return view('CrudSupervisorVendedoresDetalles', compact('vendedor', 'productos', 'cantidadProductosEnVenta', 'transa', 'cantidadTransacciones'));
    }

    public function consignasEncargado()
    {

        $consignas = Consiga::where('estado', 'Pendiente')->get();
        return view('consignasEncargados', compact('consignas'));
    }

    public function desconsignasEncargado()
    {

        $consignas = Consiga::where('estado', 'Aceptado')
            ->whereDoesntHave('producto.transacciones', function ($query) {
                $query->where('estado', 'Aceptado');
            })
            ->get();

        return view('desconsignasEncargados', compact('consignas'));
    }


    public function contraEncargado()
    {
        $usuarios = User::all();
        return view('clienteContraEncargado', compact('usuarios'));
    }
}
