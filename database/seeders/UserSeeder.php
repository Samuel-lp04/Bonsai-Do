<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Crear el usuario Administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@bonsai.com',
            'password' => Hash::make('admin123'), // Hash::make encripta la contraseña
            'rol' => 'admin', // Clave para que funcione tu navbar y middleware
        ]);

        // 2. Crear un usuario Cliente de prueba
        User::create([
            'name' => 'Cliente de Prueba',
            'email' => 'cliente@bonsai.com',
            'password' => Hash::make('cliente123'),
            'rol' => 'cliente', // O el valor que uses para los clientes normales
        ]);
    }
}