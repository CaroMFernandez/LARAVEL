<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Equipo;
use App\Models\Sprint;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';
    protected $primaryKey = 'id_proyecto';
    public $timestamps = false;

    protected $fillable = [
        'nombre_proyecto',
    ];

    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'Proyectos_id_proyecto', 'id_proyecto');
    }

    public function sprints()
    {
        return $this->hasMany(Sprint::class, 'Proyectos_id_proyecto', 'id_proyecto');
    }
}
