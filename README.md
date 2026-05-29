# Team & User Management API (Laravel CRUD)

A robust RESTful API built with Laravel 12 and PHP 8.2 designed to manage users, teams, and the roles assigned to users within specific teams. It features a custom many-to-many relationship handling mechanism using a pivot table with additional attributes (`Roles_id_rol`).

## Features

- **User Management**: Standard CRUD operations for user profiles.
- **Team Management**: Organization and tracking of workspaces.
- **Advanced Pivot Relationship**: 
  - Dynamic assignment of users to teams.
  - Role tracking inside specific teams using Laravel Eloquent's `updateExistingPivot` and `syncWithoutDetaching`.
  - Conditional retrieval using advanced SQL Left Joins.

---

## API Endpoints Reference

### Team-User Assignments

* **GET** `/api/equipos-usuarios`
  * **Description:** List all assignments (Supports `id_usuario` & `id_equipo` filters)
  * **Payload:** None

* **POST** `/api/equipos-usuarios`
  * **Description:** Link a user to a team with a specific role
  * **Payload (JSON):**
    ```json
    {
      "id_equipo": 1,
      "id_usuario": 1004,
      "id_rol": 1
    }
    ```

* **PUT** `/api/equipos-usuarios`
  * **Description:** Update user data or their role within a team
  * **Payload (JSON):**
    ```json
    {
      "id_equipo": 1,
      "id_usuario": 1004,
      "id_rol": 2
    }
    ```

* **DELETE** `/api/equipos-usuarios`
  * **Description:** Unlink/Detach a user from a team
  * **Payload (JSON):**
    ```json
    {
      "id_equipo": 1,
      "id_usuario": 1004
    }
    ```

---

## Technical Highlights (Code Implementation)

### Custom Pivot Update
Instead of dealing with native primary keys on intermediate tables, this project utilizes Eloquent's relationship tracking to update extra columns on the fly:

```php
$equipo = Equipo::find($request->id_equipo);

$equipo->usuarios()->updateExistingPivot($request->id_usuario, [
    'Roles_id_rol' => $request->id_rol
]);
