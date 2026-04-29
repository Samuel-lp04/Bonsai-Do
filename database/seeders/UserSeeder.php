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
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@bonsai.com',
            'password' => Hash::make('admin123'),
            'rol' => 'admin',
        ]);

        User::create([
            'name' => 'Cliente de Prueba',
            'email' => 'cliente@bonsai.com',
            'password' => Hash::make('cliente123'),
            'rol' => 'cliente',
        ]);
    }
}