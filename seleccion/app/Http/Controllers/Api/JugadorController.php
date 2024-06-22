<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jugador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JugadorController extends Controller
{
    public function index()
    {
        $jugadores = Jugador::all();

        $data = [
            'jugadores' => $jugadores,
            'status' => 200
        ];

        return response()->json($data, 200);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'posicion' => 'nullable|max:255',
            'club' => 'nullable|max:255',
            'edad' => 'nullable|integer|min:0',
            'numero_camiseta' => 'nullable|integer|min:0'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $jugador = Jugador::create($validator->validated());

        if (!$jugador) {
            $data = [
                'message' => 'Error al crear el jugador',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'jugador' => $jugador,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $jugador = Jugador::find($id);

        if (!$jugador) {
            $data = [
                'message' => 'Jugador no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'jugador' => $jugador,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $jugador = Jugador::find($id);

        if (!$jugador) {
            $data = [
                'message' => 'Jugador no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $jugador->delete();

        $data = [
            'message' => 'Jugador eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $jugador = Jugador::find($id);

        if (!$jugador) {
            $data = [
                'message' => 'Jugador no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'posicion' => 'nullable|max:255',
            'club' => 'nullable|max:255',
            'edad' => 'nullable|integer|min:0',
            'numero_camiseta' => 'nullable|integer|min:0'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $jugador->update($validator->validated());

        $data = [
            'message' => 'Jugador actualizado',
            'jugador' => $jugador,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function updatePartial(Request $request, $id)
    {
        // Buscar el jugador por su ID
        $jugador = Jugador::find($id);

        // Si no se encuentra el jugador, retornar un error
        if (!$jugador) {
            $data = [
                'message' => 'Jugador no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Validar los datos de la solicitud
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|max:255',
            'apellido' => 'sometimes|max:255',
            'posicion' => 'nullable|max:255',
            'club' => 'nullable|max:255',
            'edad' => 'nullable|integer|min:0',
            'numero_camiseta' => 'nullable|integer|min:0'
        ]);

        // Si la validación falla, retornar un error
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Actualizar solo los campos proporcionados en la solicitud
        $jugador->update($request->only(array_keys($validator->validated())));

        // Preparar la respuesta con el mensaje de actualización y el estado HTTP
        $data = [
            'message' => 'Jugador actualizado',
            'jugador' => $jugador,
            'status' => 200
        ];

        // Retornar la respuesta en formato JSON
        return response()->json($data, 200);
    }
}
