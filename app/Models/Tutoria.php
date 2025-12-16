<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutoria extends Model
{
    use HasFactory;
    protected $fillable = [
        'periodo_id',
        'tutor_user_id',
        'calendario_sesion_id',
        'fecha',
        'tema',
        'qr_token',
        'estado',
    ];

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_user_id');
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}
