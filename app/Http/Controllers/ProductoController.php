<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Consiga;
use App\Models\Categoria;
use App\Models\Pregunta;
use App\Models\Respuesta;
use App\Models\Transaccion;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productos = Producto::with('preguntas.user', 'respuestas.usuario', 'fotos')->get();
        $consignas = Consiga::all();
        if ($request->expectsJson()) {
            return $productos->toJson();
        } else {
            return view('producto-home', compact('productos', 'consignas'));
        }
    }
    public function mostrarFormularioCrear()
    {
        $categorias = Categoria::all();
        return view('crearProductoVendedor', compact('categorias'));
    }
    public function guardarProducto(Request $request)
    {
        // Obtener el ID del usuario autenticado
        $idUser = Auth::id();
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->idCategoria = $request->idCategoria;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->idUser = $idUser; // Asignar el ID del usuario autenticado
        $producto->precio = $request->precio;
        // Guardar el producto
        $producto->save();
    
        // Procesar las fotos
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {

            $extension = $foto->getClientOriginalExtension(); // Obtiene la extensión del archivo
            $nombreArchivo = $producto->id . '.' . $extension; //nombre del archivo
            
            $ruta = 'public/storage/fotos_productos'. $nombreArchivo; // Guarda la imagen en la carpeta "storage/app/fotos_productos"
            $foto->move(public_path('/storage/fotos_productos'), $nombreArchivo);

            //$ruta = $foto->store('fotos_productos', 'public');
            // Crear la foto y asociarla con el producto
            //$producto->fotos()->create(['ruta' => $ruta]);
    }

        $newConsigna = new Consiga();
        $newConsigna->idProducto = Producto::latest()->first()->id;
        $newConsigna->estado = 'Pendiente';
        $newConsigna->save();
        return redirect()->route('listarProductosVendedor')->with('success', 'Producto creado exitosamente');
    }
}
    
    
    public function listarProductosVendedor()
{
    $productos = Auth::user()->productos()->with('categoria', 'consignas')->get();
    

    return view('ProductosVendedor', compact('productos'));
}
    
    public function subirEvidencia($id){
        // Acceder al producto asociado a la transacción a través de la relación
        $producto = Producto::findOrFail($id);
    
        // Verificar si el producto existe para evitar errores
        if (!$producto) {
            return redirect()->back()->with('error', 'No se encontró el producto asociado a la transacción');
        }
    
        return view('subirEvidencia', compact('producto'));
    }
    
public function guardarEvidencia(Request $request, $id)
{
    $request->validate([
        'evidencia' => 'required|file',
        'calificacion' => 'required|integer|min:1|max:5',
    ]);
    $evidencia = new Transaccion();
    $obtenerProducto = Producto::findOrFail($id);

    $evidencia->idProducto = $id;
    $evidencia->cantidad = $request->input('cantidad');
    $evidencia->idUsuario = auth()->user()->id;
    $evidencia->estado = 'Pendiente';
    $evidencia->calificacion = $request->input('calificacion');
    $evidencia->precio = $request->input('cantidad') * $obtenerProducto->precio;

    $evidencia->save();

    $foto = $request->file('evidencia');
    $extension = $foto->getClientOriginalExtension(); // Obtiene la extensión del archivo
    $nombreArchivo = $evidencia->id . '.' . $extension; //nombre del archivo
            
    $ruta = 'public/storage/evidencias'. $nombreArchivo; // Guarda la imagen en la carpeta "storage/app/evidencias"
    $foto->move(public_path('/storage/evidencias'), $nombreArchivo);

    //$evidencias = $request->file('evidencia');
    //$evidenciaNombre = $evidencias->store('public/evidencias'); // Cambia 'public/evidencias' según la ruta donde desees guardar los archivos
    //$evidencia->voucher = $evidenciaNombre;

    $obtenerProducto->stock = $obtenerProducto->stock - $request->input('cantidad');
    $obtenerProducto->save();
    $evidencia->save();


    return redirect()->route('lista')->with('success', 'Evidencia y calificación guardadas correctamente');
}

public function comprarProducto(Request $request, Producto $producto)
{
    if (Auth::user()->rol == 'Cliente') {
        // Verificar si el cliente puede comprar el producto (por ejemplo, stock suficiente, etc.)
        if ($producto->stock >= $request->cantidad && $request->cantidad > 0) {
            // Disminuir el stock del producto
            $producto->stock -= $request->cantidad;
            $producto->save();

            // Subir el voucher si se proporcionó
            $voucherPath = null;
            if ($request->hasFile('voucher')) {
                $voucherPath = $request->file('voucher')->store('vouchers', 'public');
            }

            // Registrar la transacción de compra en la base de datos
            $transaccion = new Transaccion([
                'idProducto' => $producto->id,
                'cantidad' => $request->cantidad,
                'precio' => $producto->precio * $request->cantidad, // Precio total según la cantidad
                'idUsuario' => Auth::id(),
                'voucher' => $voucherPath,
                'estado' => 'Pendiente', // Puedes cambiar el estado según tu lógica de negocio
                'calificacion' => null, // Puedes establecer la calificación después
            ]);
            $transaccion->save();

            return redirect()->back()->with('success', 'Compra realizada correctamente');
        } else {
            return redirect()->back()->with('error', 'No hay suficiente stock disponible o cantidad inválida');
        }
    }

    return redirect()->back()->with('error', 'No tienes permiso para comprar este producto');
}

    public function subirFoto(Request $request, Producto $producto)
    {
        $request->validate([
            'foto' => 'required|image|max:2048', // Ajusta el tamaño máximo según tus necesidades
        ]);
    
        $foto = $request->file('foto');
        $extension = $foto->getClientOriginalExtension(); // Obtiene la extensión del archivo
        $nombreArchivo = $producto->id . '.' . $extension; //nombre del archivo
        $ruta = 'public/storage/fotos_productos'. $nombreArchivo; // Guarda la imagen en la carpeta "storage/app/fotos_productos"
    
        $foto->move(public_path('/storage/fotos_productos'), $nombreArchivo);

        $producto->fotos()->create([
            'ruta' => $ruta,
        ]);
    
        return redirect()->back()->with('success', 'Foto subida correctamente');
    }
    public function actualizar(Request $request, Producto $producto)
    {
        // Verificar si el producto está consignado
        if ($producto->consignas->contains('estado', 'Aceptado')) {
            return redirect()->back()->with('error', 'No puedes modificar un producto consignado');
        }
    
        // Validar datos del formulario y actualizar producto
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'descripcion' => 'required',
        ]);
    
        $producto->update([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
        ]);
    
        // Procesar fotos si se subieron
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $ruta = $foto->store('fotos_productos', 'public');
    
            // Guardar la foto en la base de datos
            $producto->fotos()->create([
                'ruta' => $ruta,
            ]);
        }
    
        return redirect()->route('listarProductosVendedor')->with('success', 'Producto actualizado correctamente');
    }

    public function eliminarFoto(Producto $producto, Foto $foto)
    {
        // Verificar que la foto pertenece al producto
        if ($producto->fotos->contains($foto)) {
            // Eliminar la foto
            $foto->delete();
    
            // Redirigir de vuelta con un mensaje de éxito
            return redirect()->back()->with('success', 'Foto eliminada correctamente.');
        }
    
        // Si la foto no pertenece al producto, redirigir con un mensaje de error
        return redirect()->back()->with('error', 'La foto no pertenece al producto.');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request)
    {
        //
    }
    public function eliminarProducto(Producto $producto)
{
    // Verificar si el producto tiene consignas aceptadas
    if ($producto->consignas->contains('estado', 'Aceptado')) {
        return redirect()->back()->with('error', 'No puedes eliminar un producto consignado');
    }

    // Eliminar todas las consignas asociadas al producto
    $producto->consignas()->delete();

    // Eliminar las fotos asociadas al producto
    foreach ($producto->fotos as $foto) {
        Storage::delete($foto->ruta);
        $foto->delete();
    }

    // Eliminar el producto
    $producto->delete();

    return redirect()->route('listarProductosVendedor')->with('success', 'Producto eliminado correctamente');
}
    
    public function show(Producto $producto)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('productosEditarVendedor', compact('producto'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }

    public function verDetalles($id)
    {
        // Intentar buscar el producto con relaciones
        $producto = Producto::with(['categoria', 'user', 'preguntas.respuestas'])->find($id);
    
        // Si no se encuentra, redirigir con un mensaje
        if (!$producto) {
            return redirect()->route('lista')->with('error', 'Producto no encontrado');
        }
    
        // Retornar la vista con el producto
        return view('detalles', compact('producto'));
    }
    

public function verDetallesKardex($id)
{
    // Obtener el producto
    $producto = Producto::findOrFail($id);
    $consigna = Consiga::where('idProducto', $id)->first();
    // Obtener todas las preguntas y sus respuestas asociadas al producto
    $preguntasConRespuestas = Pregunta::with('respuestas')->where('idProducto', $id)->get();


    $transas = Transaccion::where('idProducto', $id)
        ->where('estado', 'Aceptado')
        ->get();


    return view('SupervisorKardex', compact('producto', 'preguntasConRespuestas','transas','consigna'));
}



public function buscarProductos(Request $request)
{
    $searchTerm = $request->input('search');

    // Aquí iría la lógica para buscar todos los productos usando $searchTerm

    // Por ejemplo, puedes usar el modelo Producto para buscar los productos
    $consignas = Consiga::whereHas('producto', function ($query) use ($searchTerm) {
        $query->where('nombre', 'like', '%' . $searchTerm . '%');
    })->where('estado', 'Aceptado')->get();
    

    return view('producto-home', compact('consignas'));
}

public function mostrarMisProductos(){

    $userId = auth()->id();
    // Buscar las consigas del usuario autenticado
    $consignas = Consiga::whereHas('producto', function ($query) use ($userId) {
        $query->where('idUser', $userId);
    })->get();

    return view('misProductos',compact('consignas'));
}

public function mostrarMisVentas(){

    $userId = auth()->id();

    $transacciones = Transaccion::whereHas('producto',function ($query) use ($userId){
        $query->where('idUser',$userId);
    })->get();
    
    return view('misVentas',compact('transacciones'));
}


public function hacerPregunta(Request $request, $id){


    $nuevaPregunta = new Pregunta();

    $nuevaPregunta->contenido = $request->contenido;
    $nuevaPregunta->idProducto = $id;
    $nuevaPregunta->idUsuario = auth()->user()->id;
    $nuevaPregunta->save();

    return redirect(route('detalles',$id));
}

public function responderPregunta(Request $request, $id){

    $respuesta = new Respuesta();
    $respuesta->contenido = $request->contenido;
    $respuesta->idPregunta = $id;
    $respuesta->idUsuario = auth()->user()->id;
    $respuesta->save();


    $Pregunta = Pregunta::findOrFail($id);

    return redirect(route('detalles',$Pregunta->idProducto));
}

}
