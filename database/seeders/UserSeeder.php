<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Encargado','Cliente','Contador','Supervisor','Vendedor'];
        $correos = ['encargado@gmail.com','cliente@gmail.com','contador@gmail.com','supervisor@gmail.com','vendedor@gmail.com'];

        foreach ($roles as $index => $rolNombre) {
            User::firstOrCreate(
                ['email' => $correos[$index]], // Condición para evitar duplicados
                [
                    'name' => 'Usuario ' . $index,
                    'apellido_paterno' => 'Usuario' . $index,
                    'apellido_materno' => 'Usuario' . $index,
                    'fecha_nacimiento' => '2000-05-01',
                    'no_telefono' => $index + 1,
                    'sexo' => 'Masculino',
                    'direccion' => $index + 1,
                    'rol' => $rolNombre,
                    'password' => bcrypt($correos[$index]),
                ]
            );
        }

        // Crear 3 usuarios del tipo Encargado
        for ($i = 1; $i <= 3; $i++) {
            User::firstOrCreate(
                ['email' => 'encargado'.$i.'@gmail.com'],
                [
                    'name' => 'Encargado '.$i,
                    'apellido_paterno' => 'Encargado '.$i,
                    'apellido_materno' => 'Encargado '.$i,
                    'fecha_nacimiento' => '2000-05-01',
                    'no_telefono' => 661 + $i,
                    'sexo' => 'Masculino',
                    'direccion' => $i + 1,
                    'rol' => 'Encargado',
                    'password' => bcrypt('encargado'.$i.'@gmail.com'),
                ]
            );
        }

        // Crear 2 usuarios del tipo Supervisor
        for ($i = 1; $i <= 2; $i++) {
            User::firstOrCreate(
                ['email' => 'supervisor'.$i.'@gmail.com'],
                [
                    'name' => 'Supervisor '.$i,
                    'apellido_paterno' => 'Supervisor '.$i,
                    'apellido_materno' => 'Supervisor '.$i,
                    'fecha_nacimiento' => '2000-05-01',
                    'no_telefono' => 661 + $i,
                    'sexo' => 'Masculino',
                    'direccion' => $i + 1,
                    'rol' => 'Supervisor',
                    'password' => bcrypt('supervisor'.$i.'@gmail.com'),
                ]
            );
        }

        // Crear 5 vendedores
        for ($i = 1; $i <= 5; $i++) {
            User::firstOrCreate(
                ['email' => 'vendedor'.$i.'@gmail.com'],
                [
                    'name' => 'Vendedores '.$i,
                    'apellido_paterno' => 'Vendedores '.$i,
                    'apellido_materno' => 'Vendedores '.$i,
                    'fecha_nacimiento' => '2000-05-01',
                    'no_telefono' => 661 + $i,
                    'sexo' => 'Masculino',
                    'direccion' => $i + 1,
                    'rol' => 'Vendedor',
                    'password' => bcrypt('vendedor'.$i.'@gmail.com'),
                ]
            );
        }

        // Crear 5 compradores
        for ($i = 1; $i <= 5; $i++) {
            User::firstOrCreate(
                ['email' => 'comprador'.$i.'@gmail.com'],
                [
                    'name' => 'Comprador '.$i,
                    'apellido_paterno' => 'Comprador '.$i,
                    'apellido_materno' => 'Comprador '.$i,
                    'fecha_nacimiento' => '2000-05-01',
                    'no_telefono' => 661 + $i,
                    'sexo' => 'Masculino',
                    'direccion' => $i + 1,
                    'rol' => 'Cliente',
                    'password' => bcrypt('comprador'.$i.'@gmail.com'),
                ]
            );
        }
    }
}

