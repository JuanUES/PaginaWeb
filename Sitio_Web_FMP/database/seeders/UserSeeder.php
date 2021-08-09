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

        $usu = User::create([
            'name'=>'Liseth Guadalupe Merino de Córdova',
            'email'=>'12345678',
            'password'=>Hash::make('liseth'),
        ]);
        
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
        $usu->assignRole('super-admin');
        $admin->assignRole('super-admin');
        $presupuestario->assignRole('Transparencia-Presupuestario');
        $decano->assignRole('Transparencia-Decano');
        $secretario->assignRole('Transparencia-Secretario');

        // $user->assignRole('Transparencia');

        $user = User::create([
            'name' => 'Pagina Admin',
            'email' => 'Pagina@ues.edu.sv',
            'password' => Hash::make('Pagina'),
        ]);
        //Asignar el role usuario
        $user->assignRole('Pagina');

        $user = User::create([
            'name'=>'Jefe Academico',
            'email'=> 'jefe@ues.edu.sv',
            'password'=>Hash::make('jefe'),
        ]);
        //Asiginar el rol
        $user->assignRole('Jefe-Academico');
    }
}
