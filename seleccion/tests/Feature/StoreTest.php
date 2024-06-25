<?php

namespace Tests\Feature;

use App\Models\Jugador;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_store_creates_jugador()
    {
        $data = [
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            'posicion' => 'Delantero',
            'club' => 'Real Madrid',
            'edad' => 25,
            'numero_camiseta' => 7
        ];

        $response = $this->postJson('/api/Jugador', $data);

        $response->assertStatus(201);
        $response->assertJson([
            'jugador' => $data,
            'status' => 201
        ]);

        $this->assertDatabaseHas('jugadores', $data);
    }

    public function test_store_missing_required_fields()
    {
        $data = [];

        $response = $this->postJson('/api/Jugador', $data);

        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'Error en la validación de los datos',
            'status' => 400
        ]);
    }
}
