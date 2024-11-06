<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servicios = [
            ['nombre' => 'Dimensionamiento', 'descripcion' => 'Servicio de dimensionamiento de sistemas. Te ayudamos y asesoramos en buscar la solución adecuada a tu necesidad. Contamos con especialistas en cada área para tu seguridad y tranquilidad.'],
            ['nombre' => 'Venta', 'descripcion' => 'Implementamos soluciones para mejorar la seguridad y eficiencia en el control de acceso. Venta de equipos y sistemas.'],
            ['nombre' => 'Instalación', 'descripcion' => 'Preparamos e instalamos tu equipo dejándolo a punto para que trabaje adecuadamente. Instalación de equipos y sistemas.'],
            ['nombre' => 'Asesoría', 'descripcion' => 'Te ayudamos a que saques el máximo provecho a tus equipos. Asesoría personalizada para proyectos.'],
            ['nombre' => 'Mantenimiento', 'descripcion' => 'Nuestro servicio post venta te ayuda a mantener tus equipos siempre funcionando al 100%. Servicio de mantenimiento preventivo y correctivo.']
        ];

        foreach ($servicios as $servicio) {
            Servicio::firstOrCreate(['nombre' => $servicio['nombre']], $servicio);
        }
    }
}

