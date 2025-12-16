<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    use HasFactory;
    protected $fillable = [
        'asistencia_id',
        'foto_1_ruta',
        'foto_2_ruta',
    ];

    public function asistencia()
    {
        return $this->belongsTo(Asistencia::class);
    }
}
