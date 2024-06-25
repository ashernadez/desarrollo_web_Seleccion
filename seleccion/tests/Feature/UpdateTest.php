<?php

namespace Tests\Feature;

use App\Models\Jugador;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_update_updates_jugador()
    {
        $jugador = Jugador::factory()->create();

        $data = [
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            'posicion' => 'Defensa'
        ];

        $response = $this->putJson("/api/Jugador/{$jugador->id}", $data);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Jugador actualizado',
            'jugador' => $data,
            'status' => 200
        ]);

        $this->assertDatabaseHas('jugadores', $data);
    }

    public function test_update_not_found()
    {
        $data = [
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName
        ];

        $response = $this->putJson('/api/Jugador/999', $data);

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'Jugador no encontrado',
            'status' => 404
        ]);
    }
}
