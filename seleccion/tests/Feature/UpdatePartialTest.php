<?php

namespace Tests\Feature;

use App\Models\Jugador;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdatePartialTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_update_partial_updates_jugador()
    {
        $jugador = Jugador::factory()->create();

        $data = [
            'nombre' => $this->faker->firstName,
        ];

        $response = $this->patchJson("/api/Jugador/{$jugador->id}", $data);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Jugador actualizado',
            'status' => 200
        ]);

        $this->assertDatabaseHas('jugadores', $data);
    }

    public function test_update_partial_not_found()
    {
        $data = [
            'nombre' => $this->faker->firstName,
        ];

        $response = $this->patchJson('/api/Jugador/999', $data);

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'Jugador no encontrado',
            'status' => 404
        ]);
    }
}
