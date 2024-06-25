<?php

namespace Tests\Feature;

use App\Models\Jugador;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verifica que se elimine un jugador existente.
     *
     * @return void
     */
    public function test_destroy_deletes_jugador()
    {
        // Crear un jugador de ejemplo en la base de datos
        $jugador = Jugador::factory()->create();

        // Hacer una solicitud DELETE al endpoint de eliminación
        $response = $this->deleteJson("/api/Jugador/{$jugador->id}");

        // Verificar que la respuesta tenga un status 200 (éxito)
        $response->assertStatus(200);

        // Verificar que la respuesta JSON tenga el mensaje y estado correctos
        $response->assertJson([
            'message' => 'Jugador eliminado',
            'status' => 200
        ]);

        // Verificar que el jugador no exista en la base de datos después de la eliminación
        $this->assertDatabaseMissing('jugadores', ['id' => $jugador->id]);
    }

    /**
     * Verifica que se maneje correctamente el error de jugador no encontrado.
     *
     * @return void
     */
    public function test_destroy_not_found()
    {
        // Hacer una solicitud DELETE a un jugador que no existe (id inválido)
        $response = $this->deleteJson('/api/Jugador/999');

        // Verificar que la respuesta tenga un status 404 (no encontrado)
        $response->assertStatus(404);

        // Verificar que la respuesta JSON tenga el mensaje y estado correctos
        $response->assertJson([
            'message' => 'Jugador no encontrado',
            'status' => 404
        ]);
    }
}
