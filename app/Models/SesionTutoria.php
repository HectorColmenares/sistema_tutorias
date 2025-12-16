<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesionTutoria extends Model
{
    protected $table = 'sesiones_tutorias';

    protected $fillable = [
        'periodo_id',
        'numero',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'titulo',
        'descripcion',
    ];
}
