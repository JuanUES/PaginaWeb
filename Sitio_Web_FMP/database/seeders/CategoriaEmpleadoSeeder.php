<?php

namespace Database\Seeders;

use App\Models\General\CategoriaEmpleado;
use Illuminate\Database\Seeder;

class CategoriaEmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoriaEmpleado::create([
            'id'=>1,
            'categoria'=>'PUI'
       
            
        ]);
        //
        CategoriaEmpleado::create([
            'id'=>2,
            'categoria'=>'PUII'
       
            
        ]);
        //
        CategoriaEmpleado::create([
            'id'=>3,
            'categoria'=>'PUIII'
       
            
        ]);

        //
        CategoriaEmpleado::create([
            'id'=>4,
            'categoria'=>'TECNICO I'
       
            
        ]);

        //
        CategoriaEmpleado::create([
            'id'=>5,
            'categoria'=>'TECNICO Ii'
       
            
        ]);
        //
        CategoriaEmpleado::create([
            'id'=>6,
            'categoria'=>'TECNICO III'
       
            
        ]);
    }
}
