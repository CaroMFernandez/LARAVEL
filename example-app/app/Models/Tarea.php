<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Sprint;

class Tarea extends Model
{
    use HasFactory;

    protected $table = 'tareas';
    protected $primaryKey = 'id_tarea';
    public $timestamps = false;

    protected $fillable = [
        'nombre_tarea',
        'descripcion',
        'estado',
        'Sprints_id_sprint',
        'fecha_vencimiento',
    ];

    public function sprint()
    {
        return $this->belongsTo(Sprint::class, 'Sprints_id_sprint', 'id_sprint');
    }
}
