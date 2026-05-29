<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class Tickets extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Ticket::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_tarea' => 'required|string|max:45',
            'tipo_tarea_id_tipo_tarea' => 'required|integer',
            'prioridad' => 'nullable|string|max:45',
            'estado' => 'nullable|string|max:45',
            'estimacion' => 'nullable|string|max:45',
        ]);

        $ticket = Ticket::create($validated);
        return response()->json($ticket, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json(['error' => 'Ticket no encontrado'], 404);
        }

        return response()->json($ticket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json(['error' => 'Ticket no encontrado'], 404);
        }

        $validated = $request->validate([
            'nombre_tarea' => 'sometimes|required|string|max:45',
            'tipo_tarea_id_tipo_tarea' => 'sometimes|required|integer',
            'prioridad' => 'nullable|string|max:45',
            'estado' => 'nullable|string|max:45',
            'estimacion' => 'nullable|string|max:45',
        ]);

        $ticket->update($validated);
        return response()->json($ticket);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json(['error' => 'Ticket no encontrado'], 404);
        }

        $ticket->delete();
        return response()->json(['message' => 'Ticket eliminado correctamente']);
    }
}
