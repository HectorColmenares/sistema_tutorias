<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Alumno;
use App\Models\Tutor;
use App\Models\GrupoTutor;
use App\Models\Tutoria;
use App\Models\Asistencia;
use App\Models\Permiso;
use App\Models\Documento;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',
        'activo',
        'telefono',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'activo' => 'boolean',
        ];
    }

    // =========================
    // RELACIONES
    // =========================

    public function alumno()
    {
        return $this->hasOne(Alumno::class);
    }

    public function tutor()
    {
        return $this->hasOne(Tutor::class);
    }

    public function gruposComoTutor()
    {
        return $this->hasMany(GrupoTutor::class, 'tutor_user_id');
    }

    public function tutorias()
    {
        return $this->hasMany(Tutoria::class, 'tutor_user_id');
    }

    public function asistenciasComoAlumno()
    {
        return $this->hasMany(Asistencia::class, 'alumno_user_id');
    }

    public function asistenciasConfirmadas()
    {
        return $this->hasMany(Asistencia::class, 'confirmado_por_user_id');
    }

    public function permisosDecididos()
    {
        return $this->hasMany(Permiso::class, 'decidido_por_user_id');
    }

    public function documentosSubidos()
    {
        return $this->hasMany(Documento::class, 'subido_por_user_id');
    }

    public function documentosComoTutor()
    {
        return $this->hasMany(Documento::class, 'tutor_user_id');
    }

    public function documentosComoAlumno()
    {
        return $this->hasMany(Documento::class, 'alumno_user_id');
    }
}
