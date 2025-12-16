<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;
    protected $fillable = [
        'periodo_id',
        'tipo',
        'nombre_original',
        'ruta_archivo',
        'subido_por_user_id',
        'tutor_user_id',
        'alumno_user_id',
    ];

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }

    public function subidoPor()
    {
        return $this->belongsTo(User::class, 'subido_por_user_id');
    }
}
