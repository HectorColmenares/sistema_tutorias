<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reac extends Model
{
    use HasFactory;

    protected $table = 'reacs';

    protected $fillable = [
        'periodo_id',
        'created_by',
        'estado',
        'pdf_path',
        'fecha_elaboracion',

        'nombre_tutor',
        'grupo',
        'objetivo',
        'actividades_realizadas',
        'observaciones',
    ];

    protected $casts = [
        'fecha_elaboracion' => 'date',
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
