<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrevista extends Model
{
    use HasFactory;
    protected $fillable = [
        'periodo_id',
        'tutor_user_id',
        'alumno_user_id',
        'respuestas_json',
        'observaciones',
    ];

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_user_id');
    }

    public function alumno()
    {
        return $this->belongsTo(User::class, 'alumno_user_id');
    }
}
