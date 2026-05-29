---

## 🛣️ API Endpoints Reference

### Team-User Assignments (`/api/equipos-usuarios`)

| Method | Endpoint | Description | Payload (JSON) |
| :--- | :--- | :--- | :--- |
| **GET** | `/api/equipos-usuarios` | List all assignments (Supports `id_usuario` & `id_equipo` filters) | *None* |
| **POST** | `/api/equipos-usuarios` | Link a user to a team with a specific role | `{"id_equipo": 1, "id_usuario": 1004, "id_rol": 1}` |
| **PUT** | `/api/equipos-usuarios` | Update user data or their role within a team | `{"id_equipo": 1, "id_usuario": 1004, "id_rol": 2, "apellido": "Updated"}` |
| **DELETE**| `/api/equipos-usuarios` | Unlink/Detach a user from a team | `{"id_equipo": 1, "id_usuario": 1004}` |

---

## 💻 Technical Highlights (Code Implementation)

### Custom Pivot Update
Instead of dealing with native primary keys on intermediate tables, this project utilizes Eloquent's relationship tracking to update extra columns on the fly:

```php
$equipo = Equipo::find($request->id_equipo);

$equipo->usuarios()->updateExistingPivot($request->id_usuario, [
    'Roles_id_rol' => $request->id_rol
]);
