<?php

namespace Database\Factories;

use App\Models\Jugador;
use Illuminate\Database\Eloquent\Factories\Factory;

class JugadorFactory extends Factory
{
    protected $model = Jugador::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            'posicion' => $this->faker->word,
            'club' => $this->faker->company,
            'edad' => $this->faker->numberBetween(18, 40),
            'numero_camiseta' => $this->faker->numberBetween(1, 99)
        ];
    }
}
