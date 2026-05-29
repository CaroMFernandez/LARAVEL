<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipoUsuarioController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('equipos_has_usuarios')
            ->leftJoin('usuarios', 'usuarios.id_usuario', '=', 'equipos_has_usuarios.Usuarios_id_usuario')
            ->leftJoin('equipos', 'equipos.id_equipo', '=', 'equipos_has_usuarios.Equipos_id_equipo')
            ->leftJoin('roles', 'roles.id_rol', '=', 'equipos_has_usuarios.Roles_id_rol')
            ->select(
                'usuarios.id_usuario',
                'usuarios.nombre as usuario_nombre',
                'usuarios.apellido',
                'usuarios.correo',
                'equipos.id_equipo',
                'equipos.nombre_equipo',
                'equipos.Proyectos_id_proyecto',
                'roles.id_rol',
                'roles.nombre_rol'
            );

        // Filtrar por id_usuario si se proporciona
        if ($request->has('id_usuario')) {
            $query->where('usuarios.id_usuario', $request->id_usuario);
        }

        // Filtrar por id_equipo si se proporciona
        if ($request->has('id_equipo')) {
            $query->where('equipos.id_equipo', $request->id_equipo);
        }

        $relaciones = $query->get();

        return response()->json($relaciones, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_equipo' => 'required|integer|exists:equipos,id_equipo',
            'id_usuario' => 'required|integer|exists:usuarios,id_usuario',
            'id_rol' => 'nullable|integer|exists:roles,id_rol',
        ]);

        $equipo = Equipo::find($validated['id_equipo']);
        $equipo->usuarios()->syncWithoutDetaching([
            $validated['id_usuario'] => [
                'Roles_id_rol' => $validated['id_rol'] ?? null,
            ],
        ]);

        return response()->json(['message' => 'Usuario vinculado al equipo correctamente']);
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'id_equipo' => 'required|integer|exists:equipos,id_equipo',
            'id_usuario' => 'required|integer|exists:usuarios,id_usuario',
        ]);

        $equipo = Equipo::find($validated['id_equipo']);
        $equipo->usuarios()->detach($validated['id_usuario']);

        return response()->json(['message' => 'Usuario desvinculado del equipo correctamente']);
    }
    public function update(Request $request)
{
    // 1. Validar que existan las tres llaves necesarias
    $validated = $request->validate([
        'id_equipo'  => 'required|integer|exists:equipos,id_equipo',
        'id_usuario' => 'required|integer|exists:usuarios,id_usuario',
        'id_rol'     => 'required|integer|exists:roles,id_rol',
    ]);

    // 2. Buscar el equipo
    $equipo = Equipo::find($validated['id_equipo']);

    if (!$equipo) {
        return response()->json(['message' => 'Equipo no encontrado'], 404);
    }

    // 3. Actualizar la columna 'Roles_id_rol' en la tabla pivote para ese usuario
    $equipo->usuarios()->updateExistingPivot($validated['id_usuario'], [
        'Roles_id_rol' => $validated['id_rol']
    ]);

    return response()->json([
        'message' => 'Rol del usuario en el equipo actualizado correctamente'
    ], 200);
}
}
