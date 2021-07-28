<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        // \App\Models\User::factory(10)->create();
        \App\Models\Transparencia::factory(1000)->create();

        $this->call([
            RolesSeeder::class,
            UserSeeder::class,
            DirectorioSeeder::class,
        ]);
    }
}
