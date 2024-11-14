<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all(); // Obtiene todos los servicios
        return view('servicios', compact('servicios')); // Pasa los servicios a la vista ubicada en 'resources/views/servicios.blade.php'
    }

}
