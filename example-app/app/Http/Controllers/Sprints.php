<?php

namespace App\Http\Controllers;

use App\Models\Sprint;
use Illuminate\Http\Request;

class Sprints extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Sprint::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_sprint' => 'required|string|max:255',
            'Proyectos_id_proyecto' => 'required|integer',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        $sprint = Sprint::create($validated);
        return response()->json($sprint, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sprint = Sprint::find($id);

        if (!$sprint) {
            return response()->json(['error' => 'Sprint no encontrado'], 404);
        }

        return response()->json($sprint);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sprint = Sprint::find($id);

        if (!$sprint) {
            return response()->json(['error' => 'Sprint no encontrado'], 404);
        }

        $validated = $request->validate([
            'nombre_sprint' => 'sometimes|required|string|max:255',
            'Proyectos_id_proyecto' => 'sometimes|required|integer',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        $sprint->update($validated);
        return response()->json($sprint);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sprint = Sprint::find($id);

        if (!$sprint) {
            return response()->json(['error' => 'Sprint no encontrado'], 404);
        }

        $sprint->delete();
        return response()->json(['message' => 'Sprint eliminado correctamente']);
    }
}
