<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'carrera',
        'grupo',
        'numero_control',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'alumno_user_id');
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class, 'alumno_user_id');
    }

    public function entrevistas()
    {
        return $this->hasMany(Entrevista::class, 'alumno_user_id');
    }
}
