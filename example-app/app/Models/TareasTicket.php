<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TareasTicket extends Model
{
    use HasFactory;

    protected $table = 'tareas_tickets';
    protected $primaryKey = 'id_tarea';
    public $timestamps = false;

    protected $fillable = [
        'nombre_tarea',
        'tipo_tarea_id_tipo_tarea',
        'prioridad',
        'estado',
        'estimacion',
    ];
}
