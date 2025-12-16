<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarioSesion extends Model
{
    use HasFactory;
    protected $table = 'calendario_sesiones';
    protected $fillable = [
        'periodo_id',
        'numero_sesion',
        'fecha_programada',
        'fecha_reprogramada',
        'motivo_reprogramacion',
        'reprogramada_por_user_id',
    ];

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }

    public function reprogramadaPor()
    {
        return $this->belongsTo(User::class, 'reprogramada_por_user_id');
    }
}
