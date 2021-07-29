<?php

namespace Database\Seeders;

use App\Models\Horarios\Departamento;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departamento::create([
            'nombre_departamento'=>'Informática',
        ]);
        Departamento::create([
            'nombre_departamento'=>'Ciencias Económicas',
        ]);
    }
}
