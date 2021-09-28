<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        // Permission::create(['name' => 'edit articles']);
        // Permission::create(['name' => 'delete articles']);
        // Permission::create(['name' => 'publish articles']);
        // Permission::create(['name' => 'unpublish articles']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'Transparencia-Presupuestario']);
        $role = Role::create(['name' => 'Transparencia-Secretario']);
        $role = Role::create(['name' => 'Transparencia-Decano']);
        $role = Role::create(['name' => 'Transparencia-Repositorio']);
        $role = Role::create(['name' => 'Pagina']);
        $role = Role::create(['name' => 'super-admin']);
        $role = Role::create(['name' => 'Jefe-Academico']);
        $role = Role::create(['name' => 'Recurso-Humano']);
        $role = Role::create(['name' => 'Docente']);
        $role = Role::create(['name' => 'Jefe-Administrativo']);
        // $role = Role::create(['name' => 'Empleado']);// Rol por default para todos los usuarios

        // $role->givePermissionTo('edit articles');

        // or may be done by chaining
        // ->givePermissionTo(['publish articles', 'unpublish articles']);

        // $role->givePermissionTo(Permission::all());

        // ->givePermissionTo(['publish horarios', 'unpublish ']);
    }
}
