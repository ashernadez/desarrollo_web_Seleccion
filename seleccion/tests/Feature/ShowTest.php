<?php

namespace Tests\Feature;

use App\Models\Jugador;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_returns_jugador()
    {
        $jugador = Jugador::factory()->create();

        $response = $this->getJson("/api/Jugador/{$jugador->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'jugador' => $jugador->toArray(),
            'status' => 200
        ]);
    }

    public function test_show_returns_not_found()
    {
        $response = $this->getJson('/api/Jugador/999');

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'Jugador no encontrado',
            'status' => 404
        ]);
    }
}
