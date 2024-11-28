<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    // Mostrar la lista de direcciones
    public function index()
    {
        $addresses = Address::where('user_id', auth()->id())->get();

        return view('Selecionar-Direccion', compact('addresses'));
    }

    // Mostrar el formulario para agregar una dirección
    public function create()
    {
        return view('agregar-direccion');
    }

    // Guardar una nueva dirección
    public function store(Request $request)
    {
        $request->validate([
            'calle' => 'required|string|max:255',
            'numero_casa' => 'required|string|max:50',
            'colonia' => 'required|string|max:255',
            'estado' => 'required|string|max:100',
            'municipio' => 'required|string|max:100',
            'codigo_postal' => 'required|string|max:10',
            'nombre_recibe' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20', // Validación para el número de teléfono
            'referencias' => 'nullable|string|max:500',
            'entre_calles' => 'nullable|string|max:500',
        ]);

        Address::create([
            'user_id' => auth()->id(),
            'calle' => $request->calle,
            'numero_casa' => $request->numero_casa,
            'colonia' => $request->colonia,
            'estado' => $request->estado,
            'municipio' => $request->municipio,
            'codigo_postal' => $request->codigo_postal,
            'nombre_recibe' => $request->nombre_recibe,
            'phone_number' => $request->phone_number, // Guardar el número de teléfono
            'referencias' => $request->referencias,
            'entre_calles' => $request->entre_calles,
            'is_default' => false,
        ]);

        return redirect()->route('direccion.index')->with('success', 'Dirección agregada correctamente.');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'calle' => 'required|string|max:255',
            'numero_casa' => 'required|string|max:50',
            'colonia' => 'required|string|max:255',
            'estado' => 'required|string|max:100',
            'municipio' => 'required|string|max:100',
            'codigo_postal' => 'required|string|max:10',
            'nombre_recibe' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20', // Validación para el número de teléfono
            'referencias' => 'nullable|string|max:500',
            'entre_calles' => 'nullable|string|max:500',
        ]);

        $address = Address::where('id', $id)->where('user_id', auth()->id())->first();

        if ($address) {
            $address->update([
                'calle' => $request->calle,
                'numero_casa' => $request->numero_casa,
                'colonia' => $request->colonia,
                'estado' => $request->estado,
                'municipio' => $request->municipio,
                'codigo_postal' => $request->codigo_postal,
                'nombre_recibe' => $request->nombre_recibe,
                'phone_number' => $request->phone_number, // Actualizar el número de teléfono
                'referencias' => $request->referencias,
                'entre_calles' => $request->entre_calles,
            ]);

            return redirect()->route('direccion.index')->with('success', 'Dirección actualizada correctamente.');
        }

        return redirect()->route('direccion.index')->withErrors('No se pudo actualizar la dirección.');
    }


    public function edit($id)
    {
        $address = Address::where('id', $id)->where('user_id', auth()->id())->first();

        if ($address) {
            return view('agregar-direccion', compact('address'));
        }

        return redirect()->route('direccion.index')->withErrors('No se encontró la dirección.');
    }

    public function destroy($id)
    {
        $address = Address::where('id', $id)->where('user_id', auth()->id())->first();

        if ($address) {
            $address->delete();
            return redirect()->route('direccion.index')->with('success', 'Dirección eliminada correctamente.');
        }

        return redirect()->route('direccion.index')->withErrors('No se pudo eliminar la dirección.');
    }
    
}

