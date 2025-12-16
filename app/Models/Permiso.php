<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;
    protected $fillable = [
        'asistencia_id',
        'motivo',
        'descripcion',
        'archivo_ruta',
        'estado',
        'decidido_por_user_id',
        'decidido_en',
    ];

    public function asistencia()
    {
        return $this->belongsTo(Asistencia::class);
    }

    public function decididoPor()
    {
        return $this->belongsTo(User::class, 'decidido_por_user_id');
    }
}
