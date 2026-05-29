<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class Tareas extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Tarea::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_tarea' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string|in:pendiente,en_progreso,completada',
            'Sprints_id_sprint' => 'required|integer',
            'fecha_vencimiento' => 'nullable|date',
        ]);

        $tarea = Tarea::create($validated);
        return response()->json($tarea, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tarea = Tarea::find($id);

        if (!$tarea) {
            return response()->json(['error' => 'Tarea no encontrada'], 404);
        }

        return response()->json($tarea);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tarea = Tarea::find($id);

        if (!$tarea) {
            return response()->json(['error' => 'Tarea no encontrada'], 404);
        }

        $validated = $request->validate([
            'nombre_tarea' => 'sometimes|required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'sometimes|required|string|in:pendiente,en_progreso,completada',
            'Sprints_id_sprint' => 'sometimes|required|integer',
            'fecha_vencimiento' => 'nullable|date',
        ]);

        $tarea->update($validated);
        return response()->json($tarea);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tarea = Tarea::find($id);

        if (!$tarea) {
            return response()->json(['error' => 'Tarea no encontrada'], 404);
        }

        $tarea->delete();
        return response()->json(['message' => 'Tarea eliminada correctamente']);
    }
}
