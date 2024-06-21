<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use Illuminate\Http\Request;

class JugadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jugadores = Jugador::all();
        return view('jugadores.index', compact('jugadores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jugadores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'posicion' => 'nullable|string|max:50',
            'numero_camiseta' => 'nullable|integer',
            'club' => 'nullable|string|max:100',
            'edad' => 'nullable|integer',
        ]);

        try {
            Jugador::create($request->all());
            return redirect()->route('jugadores.index')->with('success', 'Jugador creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el jugador: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Jugador $jugador)
    {
        return view('jugadores.show', compact('jugador'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jugador $jugador)
    {
        return view('jugadores.edit', compact('jugador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jugador $jugador)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'posicion' => 'nullable|string|max:50',
            'numero_camiseta' => 'nullable|integer',
            'club' => 'nullable|string|max:100',
            'edad' => 'nullable|integer',
        ]);

        try {
            $jugador->update($request->all());
            return redirect()->route('jugadores.index')->with('success', 'Jugador actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el jugador: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jugador $jugador)
    {
        try {
            $jugador->delete();
            return redirect()->route('jugadores.index')->with('success', 'Jugador eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el jugador: ' . $e->getMessage());
        }
    }
}
