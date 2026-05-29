<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Proyecto;
use App\Models\Tarea;

class Sprint extends Model
{
    use HasFactory;

    protected $table = 'sprints';
    protected $primaryKey = 'id_sprint';
    public $timestamps = false;

    protected $fillable = [
        'nombre_sprint',
        'Proyectos_id_proyecto',
        'fecha_inicio',
        'fecha_fin',
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'Proyectos_id_proyecto', 'id_proyecto');
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'Sprints_id_sprint', 'id_sprint');
    }
}
