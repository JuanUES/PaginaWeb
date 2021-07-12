<?php

namespace Database\Factories;

use App\Models\Transparencia;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransparenciaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transparencia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titulo' =>$this->faker->name,
            'descripcion' =>$this->faker->text,
            'documento' => 'uploads/transparencia/LsadrX2w6LexQp5TB82nHI69w1QtUcIYpzOOjK3z.pdf',
            'publicar' => 'publicado',
            'categoria' => $this->faker->randomElement(['marco-normativo', 'marco-gestion', 'marco-presupuestario', 'estadisticas', 'documentos-JD']),
            'subcategoria' => $this->faker->randomElement(['agendas', 'actas', 'acuerdos']),
            'estado' => 'activo'
        ];
    }
}
