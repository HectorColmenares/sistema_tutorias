<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resa extends Model
{
    use HasFactory;

    protected $table = 'resas';

    protected $fillable = [
        'periodo_id',
        'created_by',
        'estado',
        'pdf_path',
        'fecha_elaboracion',

        'nombre_tutor',
        'carrera',
        'total_alumnos',
        'descripcion_actividades',
        'resultados',
        'conclusiones',
    ];

    protected $casts = [
        'fecha_elaboracion' => 'date',
        'total_alumnos' => 'integer',
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
