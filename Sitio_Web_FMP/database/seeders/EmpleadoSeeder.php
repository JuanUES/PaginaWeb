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
            'nombre'=>'Martín',
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
            'id_depto'=>1,
            'nombre'=>' Jonathan Adrian',
            'apellido'=>'Aguilar Garcia',
            'dui'=>'03379875-5',
            'nit'=>'0614-130985-125-5',
            'telefono'=>'7696-6969',
            'categoria'=>2,
            'tipo_empleado'=>'Académico',
            'jefe'=>1,
            'id_tipo_jornada'=>2,
            'id_tipo_contrato'=>2
            
        ]);

        Empleado::create([
            'id_depto'=>2,
            'nombre'=>' Jonathan Adrian1',
            'apellido'=>'Aguilar Garcia1',
            'dui'=>'03379875-5',
            'nit'=>'0614-130985-125-5',
            'telefono'=>'7696-6969',
            'categoria'=>2,
            'tipo_empleado'=>'Administrativo',
            'id_tipo_jornada'=>2,
            'id_tipo_contrato'=>2
            
        ]);

        Empleado::create([
            'id_depto'=>2,
            'nombre'=>' Jonathan Adrian1',
            'apellido'=>'Aguilar Garcia1',
            'dui'=>'03379875-5',
            'nit'=>'0614-130985-125-5',
            'telefono'=>'7696-6969',
            'categoria'=>2,
            'tipo_empleado'=>'Académico',
            'jefe'=>4,
            'id_tipo_jornada'=>2,
            'id_tipo_contrato'=>2
        ]);

        Empleado::create([
            'id_depto'=>2,
            'nombre'=>'Gilberto',
            'apellido'=>'Gómez',
            'dui'=>'0987896-4',
            'nit'=>'0614-180560-020-6',
            'telefono'=>'7890-6574',
            'categoria'=>1,
            'tipo_empleado'=>'Académico',
            'jefe'=>4,
            'id_tipo_jornada'=>2,
            'id_tipo_contrato'=>2
            
        ]);

        Empleado::create([
            'id_depto'=>3,
            'nombre'=>'Samuel',
            'apellido'=>'Fernández',
            'dui'=>'0987896-4',
            'nit'=>'0614-180560-020-6',
            'telefono'=>'7890-6574',
            'categoria'=>1,
            'tipo_empleado'=>'Académico',
            'id_tipo_jornada'=>1,
            'id_tipo_contrato'=>1
            
        ]);

        Empleado::create([
            'id_depto'=>3,
            'nombre'=>'Lucía',
            'apellido'=>'López',
            'dui'=>'0987896-4',
            'nit'=>'0614-180560-020-6',
            'telefono'=>'7890-6574',
            'categoria'=>1,
            'tipo_empleado'=>'Académico',
            'jefe'=>7,
            'id_tipo_jornada'=>1,
            'id_tipo_contrato'=>1
            
        ]);

        Empleado::create([
            'id_depto'=>3,
            'nombre'=>'Sofía',
            'apellido'=>'García',
            'dui'=>'0987896-4',
            'nit'=>'0614-180560-020-6',
            'telefono'=>'7890-6574',
            'categoria'=>1,
            'tipo_empleado'=>'Académico',
            'jefe'=>7,
            'id_tipo_jornada'=>1,
            'id_tipo_contrato'=>1
            
        ]);

        Empleado::create([
            'id_depto'=>4,
            'nombre'=>'Paula',
            'apellido'=>'Romero',
            'dui'=>'0987896-4',
            'nit'=>'0614-180560-020-6',
            'telefono'=>'7890-6574',
            'categoria'=>5,
            'tipo_empleado'=>'Administrativo',
            'id_tipo_jornada'=>1,
            'id_tipo_contrato'=>1
            
        ]);

        Empleado::create([
            'id_depto'=>4,
            'nombre'=>' Valeria',
            'apellido'=>'Sánchez',
            'dui'=>'03379875-5',
            'nit'=>'0614-130985-125-5',
            'telefono'=>'7696-6969',
            'categoria'=>5,
            'tipo_empleado'=>'Administrativo',
            'jefe'=>10,
            'id_tipo_jornada'=>1,
            'id_tipo_contrato'=>1
        ]);

        Empleado::create([
            'id_depto'=>4,
            'nombre'=>' Federico',
            'apellido'=>'Fuentes',
            'dui'=>'03379875-5',
            'nit'=>'0614-130985-125-5',
            'telefono'=>'7696-6969',
            'categoria'=>5,
            'tipo_empleado'=>'Administrativo',
            'jefe'=>10,
            'id_tipo_jornada'=>1,
            'id_tipo_contrato'=>1
        ]);

        Empleado::create([
            'id_depto'=>5,
            'nombre'=>' Diego',
            'apellido'=>'Figueroa',
            'dui'=>'03379875-5',
            'nit'=>'0614-130985-125-5',
            'telefono'=>'7696-6969',
            'categoria'=>4,
            'tipo_empleado'=>'Administrativo',
            'id_tipo_jornada'=>1,
            'id_tipo_contrato'=>1
        ]);

        Empleado::create([
            'id_depto'=>5,
            'nombre'=>' Daniel',
            'apellido'=>'Castillo',
            'dui'=>'03379875-5',
            'nit'=>'0614-130985-125-5',
            'telefono'=>'7696-6969',
            'categoria'=>4,
            'tipo_empleado'=>'Administrativo',
            'jefe'=>13,
            'id_tipo_jornada'=>1,
            'id_tipo_contrato'=>1
        ]);

        Empleado::create([
            'id_depto'=>5,
            'nombre'=>' César',
            'apellido'=>'Campos	',
            'dui'=>'03379875-5',
            'nit'=>'0614-130985-125-5',
            'telefono'=>'7696-6969',
            'categoria'=>4,
            'tipo_empleado'=>'Administrativo',
            'jefe'=>13,
            'id_tipo_jornada'=>1,
            'id_tipo_contrato'=>1
        ]);

    }
}
