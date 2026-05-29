<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Usuario;

class Equipo extends Model
{
    protected $table = 'equipos';
    protected $primaryKey = 'id_equipo';
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nombre_equipo',
        'Proyectos_id_proyecto',
    ];

    public function usuarios(): BelongsToMany
    {
        return $this->belongsToMany(
            Usuario::class,
            'equipos_has_usuarios',
            'Equipos_id_equipo',
            'Usuarios_id_usuario'
        )->withPivot('Roles_id_rol');
    }
}
