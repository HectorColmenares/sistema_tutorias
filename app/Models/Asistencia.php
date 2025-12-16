<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $fillable = [
        'tutoria_id',
        'alumno_user_id',
        'estado',
        'confirmado_por_user_id',
        'confirmado_en',
    ];

    public function tutoria()
    {
        return $this->belongsTo(Tutoria::class);
    }

    public function alumno()
    {
        return $this->belongsTo(User::class, 'alumno_user_id');
    }

    public function confirmador()
    {
        return $this->belongsTo(User::class, 'confirmado_por_user_id');
    }

    public function evidencia()
    {
        return $this->hasOne(Evidencia::class);
    }

    public function permiso()
    {
        return $this->hasOne(Permiso::class);
    }
}
