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
        // Limpia la tabla de usuarios antes de insertar nuevos registros
        User::truncate();

        User::create([
            'name' => 'SISTEMAS FREE',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'CLIENTE',
            'email' => 'cliente@gmail.com',
            'password' => bcrypt('client123'),
            'role' => 'cliente'
        ]);

        // Si necesitas generar usuarios adicionales, descomenta la línea de abajo
        User::factory()->count(10)->create(['role' => 'cliente']);
    }
}
