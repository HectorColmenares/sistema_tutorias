<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'activo',
    ];
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin'    => 'date',
        'activo'       => 'boolean',
    ];

    public function tutorias()
    {
        return $this->hasMany(Tutoria::class);
    }

    public function calendarioSesiones()
    {
        return $this->hasMany(CalendarioSesion::class);
    }

    public function gruposTutores()
    {
        return $this->hasMany(GrupoTutor::class);
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class);
    }

    public function entrevistas()
    {
        return $this->hasMany(Entrevista::class);
    }
}
