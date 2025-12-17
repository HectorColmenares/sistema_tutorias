<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pat extends Model
{
    use HasFactory;

    protected $table = 'pats';

    protected $fillable = [
        'periodo_id',
        'created_by',
        'estado',
        'pdf_path',
        'fecha_elaboracion',

        'nombre_tutor',
        'grupo',
        'diagnostico',
        'objetivo_general',
        'acciones',
        'metas',
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
