<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServiciosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    Servicio::create([
        'nombre' => 'Servicio 1',
        'descripcion' => 'Descripción del servicio 1',
    ]);

    Servicio::create([
        'nombre' => 'Servicio 2',
        'descripcion' => 'Descripción del servicio 2',
    ]);

    // Puedes agregar más servicios aquí.
}
}
