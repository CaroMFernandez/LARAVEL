<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Equipo;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellido',
        'correo',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function equipos(): BelongsToMany
    {
        return $this->belongsToMany(
            Equipo::class,
            'equipos_has_usuarios',
            'Usuarios_id_usuario',
            'Equipos_id_equipo'
        )->withPivot('Roles_id_rol');
    }
}
