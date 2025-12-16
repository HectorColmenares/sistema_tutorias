<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;
    protected $table = 'calificaciones';
    protected $fillable = [
        'periodo_id',
        'tutor_user_id',
        'alumno_user_id',
        'unidad_1',
        'unidad_2',
        'unidad_3',
        'unidad_4',
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
