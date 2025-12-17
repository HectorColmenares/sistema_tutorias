<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    use HasFactory;

    protected $table = 'informes';

    protected $fillable = [
        'periodo_id',
        'created_by',
        'estado',
        'pdf_path',
        'fecha_elaboracion',

        'nombre_tutor',
        'grupo',
        'alumnos_atendidos',
        'problematicas_detectadas',
        'acciones_realizadas',
        'recomendaciones',
    ];

    protected $casts = [
        'fecha_elaboracion' => 'date',
        'alumnos_atendidos' => 'integer',
    ];

    /* ================= RELACIONES ================= */

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }

    public function creador()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
