<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConsigaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\TransaccionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\pagopay;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\PedidoController;


//inicio
Route::get('/', function () {
    return view('home');
});

//SESION INICIO
Route::get('/login',[SessionController::class, 'create'])->name('login.index');
Route::post('/login',[SessionController::class, 'store'])->name('login.store');
Route::get('/login2',[SessionController::class,'manejarinicio'])->name('login.manejo');


//SESION SALIDA
Route::get('/logout',[SessionController::class, 'destroy'])->name('login.out');

//REGISTRAR USUARIO
// Ruta para mostrar el formulario de registro
Route::get('/registrar-usuario', [UserController::class, 'create'])->name('user.register');

// Ruta para almacenar el usuario
Route::post('/registrar-usuario', [UserController::class, 'store'])->name('user.store');




//CATEGORIA CLIENTE
Route::get('/mostrar-categorias',[CategoriaController::class, 'show'])->name('ShowCategorias');
Route::post('/producto/{id}/preguntar', [ProductoController::class, 'hacerPregunta'])->name('hacerPregunta');
Route::get('subirEvidencia/{producto}', [ProductoController::class, 'subirEvidencia'])->name('subirEvidencia');
Route::post('guardarEvidencia/{producto}', [ProductoController::class, 'guardarEvidencia'])->name('guardarEvidencia');


//INCIO DE SESION POR ROLES
Route::get('/cliente',[RolesController::class, 'cliente'])->middleware('auth.cliente')->name('home.cliente');
Route::get('/contador',[RolesController::class, 'contador'])->middleware('auth.contador')->name('home.contador');
Route::get('/encargado',[RolesController::class, 'encargado'])->middleware('auth.encargado')->name('home.encargado');
Route::get('/supervisor',[RolesController::class, 'supervisor'])->middleware('auth.supervisor')->name('home.supervisor');
Route::get('/vendedor',[RolesController::class, 'vendedor'])->middleware('auth.vendedor')->name('home.vendedor');

//VENDEDOR

Route::get('vendedor/misProducto',[ProductoController::class, 'mostrarMisProductos'])->name('mProductos');
Route::get('vendedor/productosComprados',[ProductoController::class, 'mostrarMisVentas'])->name('mVentas');
Route::post('/producto/{id}/responder', [ProductoController::class, 'responderPregunta'])->name('responderPregunta');
Route::get('/productos/{producto}/editar', [ProductoController::class, 'edit'])->name('productosEditar');
Route::put('/productos/{producto}', [ProductoController::class, 'actualizar'])->name('productosActualizar');
Route::delete('/productos/{producto}', [ProductoController::class, 'eliminarProducto'])->name('eliminarProducto');
Route::post('/productos/{producto}/subir-foto', [ProductoController::class, 'subirFoto'])->name('SubirFoto');
Route::delete('/producto/{foto}/eliminar-foto', [ProductoController::class, 'eliminarFoto'])->name('eliminarFoto');
Route::post('/productos/crear', [ProductoController::class, 'guardarProducto'])->name('guardarProducto');
Route::get('/productos/crear', [ProductoController::class, 'mostrarFormularioCrear'])->name('crearProducto');


//PRODUCTOS
Route::get('/listar-productos',[ProductoController::class, 'index'])->name('lista');
Route::get('/productos/{id}', [ProductoController::class, 'verDetalles'])->name('detalles');
Route::get('/supervisor/productosKardex/{id}', [ProductoController::class, 'verDetallesKardex'])->name('Kardex');
Route::get('/buscar-productos', [ProductoController::class, 'buscarProductos'])->name('buscarProductos');
Route::get('/productos-vendedor', [ProductoController::class, 'listarProductosVendedor'])->name('listarProductosVendedor');
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');

//CARRITO
Route::group(['middleware' => 'web'], function () {
    Route::get('/carrito', [CartController::class, 'index'])->name('carrito.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/carrito/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/count', [CartController::class, 'getCount'])->name('cart.count');
    Route::get('/stripe', [CartController::class, 'stripe'])->name('stripe.index');

});


//seleccionar direccion
Route::middleware(['auth'])->group(function () {
    Route::get('/direccion', [AddressController::class, 'index'])->name('direccion.index');
    Route::get('/direccion/create', [AddressController::class, 'create'])->name('direccion.create');
    Route::post('/direccion', [AddressController::class, 'store'])->name('direccion.store');
    Route::get('/direccion/{id}/edit', [AddressController::class, 'edit'])->name('direccion.edit');
    Route::put('/direccion/{id}', [AddressController::class, 'update'])->name('direccion.update');
    Route::delete('/direccion/{id}', [AddressController::class, 'destroy'])->name('direccion.destroy');
});





//pago
Route::get('/stripe', [StripeController::class, 'index'])->name('stripe.index');
Route::post('/stripe', [StripeController::class, 'processPayment'])->name('stripe.process');
Route::get('/payment-success', function () {
    return view('stripe.success');
})->name('payment.success');

Route::get('/payment-failed', function () {
    return view('stripe.failed');
})->name('payment.failed');


//PEDIDOS
Route::get('/pedidos', [PedidoController::class, 'misPedidos'])->name('mis-pedidos')->middleware('auth');


//SERVICIOS
Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios.index');




//CATEGORIAS
Route::get('categorias', [CategoriaController::class, 'index'])->name('categorias');
Route::get('categorias/{id}/productos', [CategoriaController::class, 'productosPorCategoria'])->name('productosPorCategoria');

                //PARA SUPERVISOR


// CRUD CATEGORIAS PARA SUPERVISOR
Route::get('supervisor/categorias', [CategoriaController::class, 'crud'])->name('CrudSupervisorCategorias');
Route::get('categorias/create', [CategoriaController::class, 'create'])->name('CreateCategorias');
Route::post('categorias', [CategoriaController::class, 'store'])->name('StoreCategorias');
Route::get('categorias/{id}/edit', [CategoriaController::class, 'edit'])->name('EditCategorias');
Route::put('categorias/{id}', [CategoriaController::class, 'update'])->name('UpdateCategorias');
Route::delete('categorias/{id}', [CategoriaController::class, 'destroy'])->name('DestroyCategorias');
Route::get('categorias/{id}/productos-supervisor', [CategoriaController::class, 'productosPorCategoriaSup'])->name('ProductosCategoriaSupervisor');

// CRUD USUARIO PARA SUPERVISOR
Route::get('supervisor/usuarios',[UsuarioController::class,'index'])->name('CrudSupervisorUsuarios');
Route::get('usuarios/create', [UsuarioController::class, 'create'])->name('CreateUsuario');
Route::post('usuarios', [UsuarioController::class, 'store'])->name('StoreUsuario');
Route::get('usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('EditUsuario');
Route::put('usuarios/{id}', [UsuarioController::class, 'update'])->name('UpdateUsuario');
Route::delete('usuarios/{id}', [UsuarioController::class, 'destroy'])->name('DestroyUsuario');
Route::get('/supervisor/vendedores',[UsuarioController::class, 'indexVendor'])->name('UsuariosVendedores');
Route::get('/supervisor/vendedores/detalles/{id}',[UsuarioController::class, 'detalleVendor'])->name('DetalleVendedores');



            //ENCARGADO

Route::get('encargado/consignar',[UsuarioController::class, 'consignasEncargado'])->middleware('auth.encargado')->name('consignar');
Route::get('encargado/desconsignar',[UsuarioController::class, 'desconsignasEncargado'])->name('desconsignar');
Route::get('encargado/consignar/producto{id}',[ConsigaController::class, 'consignasEncargadoProducto'])->name('consignarProducto');
Route::put('encargado/consignar/producto{id}', [ConsigaController::class, 'actualizar'])->name('Updateconsigna');
Route::get('encargado/desconsignar/producto{id}',[ConsigaController::class, 'desconsignasEncargadoProducto'])->name('desconsignarProducto');
Route::put('encargado/desconsignar/producto{id}',[ConsigaController::class, 'actualizarDesconsignas'])->name('Desconsignar');

//CONTRASENIAS

Route::get('encargado/cambio-contrasena/home',[UsuarioController::class, 'contraEncargado'])->name('ContraEncargadoVista');






        //CONTADORES

Route::get('contador/mostrar-transacciones/home',[TransaccionController::class, 'index'])->name('mostrarTransacciones');
Route::get('contador/mostrar-transacciones/transacciones{id}',[TransaccionController::class, 'indexEsp'])->name('mostrarTransaccionesDetalles');
Route::put('contador/mostrar-transacciones/transacciones{id}',[TransaccionController::class, 'updatetransaccion'])->name('transaccion');

//PAGOS
Route::get('contador/Iniciar-Pagos',[UsuarioController::class,'index'])->name('PagosIniciar');
Route::get('contador/Continuar-Pagos/Vendedor{id}',[PagoController::class, 'magia'])->name('vamosahacermagia');

//Listar-PAGOS

Route::get('contador/Listar-Pagos',[PagoController::class, 'index'])->name('ListarPagos');
Route::get('contador/Listar-Pagos/pago{id}',[PagoController::class, 'detalles'])->name('DetallarPago');
Route::put('contador/Listar-Pagos/pago{id}',[PagoController::class, 'actualizardetalles'])->name('ActualizarPago');


//footer
Route::post('/send-message', function (Request $request) {
    // Validar los datos del formulario
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|digits:10',
        'email' => 'required|email',
        'message' => 'required|string',
    ]);

    // Aquí puedes agregar la lógica para enviar el correo (si lo deseas)

    // Redirigir de vuelta con el mensaje de éxito
    return back()->with('success', 'Mensaje enviado con éxito');
});