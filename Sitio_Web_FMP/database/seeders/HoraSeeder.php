<?php

namespace Database\Seeders;

use App\Models\Horarios\Hora;
use Illuminate\Database\Seeder;

class HoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hora::create([
            'horas'=>'08:00-10:00',
        ]);

        Hora::create([
            'horas'=>'10:00-12:00',
        ]);
    }
}
