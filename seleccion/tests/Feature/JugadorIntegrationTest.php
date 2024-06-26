<?php

namespace Tests\Feature;

use App\Models\Jugador;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JugadorIntegrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verifica el flujo completo de CRUD para jugadores.
     *
     * @return void
     */
    public function test_jugador_crud_flow()
    {
        // Crear un jugador
        $response = $this->postJson('/api/Jugador', [
            'nombre' => 'Juan',
            'apellido' => 'Perez',
            'posicion' => 'Delantero',
            'club' => 'FC Barcelona',
            'edad' => 25,
            'numero_camiseta' => 10
        ]);

        $response->assertStatus(201); // Verificar creación exitosa
        $jugadorId = $response->json('jugador.id');

        // Obtener detalles del jugador recién creado
        $response = $this->getJson("/api/Jugador/{$jugadorId}");
        $response->assertStatus(200); // Verificar que se obtenga correctamente

        // Actualizar el jugador
        $response = $this->putJson("/api/Jugador/{$jugadorId}", [
            'nombre' => 'Juan Carlos',
            'apellido' => 'Pérez', // Agregar el apellido requerido
            'edad' => 26
        ]);
        $response->assertStatus(200); // Verificar actualización exitosa
            

        // Eliminar el jugador
        $response = $this->deleteJson("/api/Jugador/{$jugadorId}");
        $response->assertStatus(200); // Verificar eliminación exitosa
    }
}
