<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;


class Equipos extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(Equipo::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) //post, crear un nuevo equipo con las "Proyectos_id_proyecto" < 80
    {
        $validated = $request->validate([
            'nombre_equipo'          => 'required|string|max:255',
            'Proyectos_id_proyecto'  => 'required|integer', // O la regla que corresponda
        ]);

        $equipo = Equipo::create($validated);
        return response()->json($equipo, 202);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $equipo = Equipo::find($id);
        
        if (!$equipo) {
            return response()->json(['error' => 'Equipo no encontrado'], 404);
        }

        return response()->json($equipo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $equipo = Equipo::find($id);
        
        if (!$equipo) {
            return response()->json(['error' => 'Equipo no encontrado'], 404);
        }

        $equipo->update($request->all());
        return response()->json($equipo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $equipo = Equipo::find($id);

        if (!$equipo) {
            return response()->json(['error' => 'Equipo no encontrado'], 404);
        }

        $equipo->delete();
        return response()->json(['message' => 'Eliminado correctamente']);
    }
}