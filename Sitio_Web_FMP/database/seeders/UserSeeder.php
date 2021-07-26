<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
        ]);
        $presupuestario = User::create([
            'name' => 'Presupuestario',
            'email' => 'presupuestario@gmail.com',
            'password' => Hash::make('presupuestario'),
        ]);
        $decano = User::create([
            'name' => 'Decano',
            'email' => 'decano@gmail.com',
            'password' => Hash::make('decano'),
        ]);
        $secretario = User::create([
            'name' => 'Secretario',
            'email' => 'secretario@gmail.com',
            'password' => Hash::make('secretario'),
        ]);
        //Asignar el role usuario
        $admin->assignRole('super-admin');
        $presupuestario->assignRole('Transparencia-Presupuestario');
        $decano->assignRole('Transparencia-Decano');
        $secretario->assignRole('Transparencia-Secretario');
    }
}
