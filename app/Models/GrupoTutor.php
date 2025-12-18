<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoTutor extends Model
{
    use HasFactory;

    protected $table = 'grupos_tutores';

    protected $fillable = [
        'periodo_id',
        'grupo',
        'tutor_user_id',
    ];

    /**
     * Si tu tabla grupos_tutores NO tiene created_at / updated_at,
     * deja esto en false. Si SÍ los tiene, cámbialo a true o elimina esta línea.
     */
    public $timestamps = false;

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_user_id');
    }

    /**
     * Alumnos pertenecientes a este grupo (relación por el campo "grupo").
     * Nota: esta relación NO filtra por periodo porque Alumno no guarda periodo.
     */
    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'grupo', 'grupo');
    }
}
