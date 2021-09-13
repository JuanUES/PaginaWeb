<?php

namespace Database\Seeders;
use App\Models\General\Empleado;
use Illuminate\Database\Seeder;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empleado::create([
            'id_depto'=>1,
            'nombre'=>'Juan Carlos',
            'apellido'=>'Moz Montoya',
            'dui'=>'0987896-4',
            'nit'=>'0614-180560-020-6',
            'telefono'=>'7890-6574',
            'categoria'=>1,
            'tipo_empleado'=>'Académico',
            'id_tipo_jornada'=>1,
            'id_tipo_contrato'=>1
            
        ]);
        //

        Empleado::create([
            'id_depto'=>2,
            'nombre'=>' Jonathan Adrian',
            'apellido'=>'Aguilar Garcia',
            'dui'=>'03379875-5',
            'nit'=>'0614-130985-125-5',
            'telefono'=>'7696-6969',
            'categoria'=>2,
            'tipo_empleado'=>'Administrativo',
            'id_tipo_jornada'=>2,
            'id_tipo_contrato'=>2
            
        ]);
    }
}
