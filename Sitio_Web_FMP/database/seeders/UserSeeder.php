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
        $user = User::create([
            'name' => 'Transparencia Admin',
            'email' => 'transparencia@gmail.com',
            'password' => Hash::make('transparencia'),
        ]);
        //Asignar el role usuario
        $user->assignRole('Transparencia');

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
        $user->assignRole('jefe_academico');
    }
}
