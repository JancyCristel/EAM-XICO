<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;
use Exception; // Importa la clase Exception

class ServicioController extends Controller
{
    public function index()
    {
        try {
            $servicios = Servicio::all(); // Obtiene todos los servicios
            return view('servicios', compact('servicios')); // Pasa los servicios a la vista
        } catch (Exception $e) {
            // En caso de un error, puedes devolver un mensaje o una vista de error
            return response()->view('errors.custom', ['message' => 'Hubo un problema al obtener los servicios: ' . $e->getMessage()], 500);
        }
    }
}

