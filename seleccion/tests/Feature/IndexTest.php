<?php

namespace Tests\Feature;

use App\Models\Jugador;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_all_jugadores()
    {
        // Crear algunos jugadores en la base de datos
        Jugador::factory()->count(3)->create();

        // Hacer una solicitud GET al endpoint index
        $response = $this->getJson('/api/Jugador');

        // Verificar que la respuesta tenga un status 200
        $response->assertStatus(200);

        // Verificar que la respuesta JSON tenga la estructura correcta
        $response->assertJsonStructure([
            'jugadores',
            'status'
        ]);

        // Verificar que la respuesta JSON tenga 3 jugadores
        $response->assertJsonCount(3, 'jugadores');
    }
}
