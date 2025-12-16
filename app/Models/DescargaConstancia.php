<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescargaConstancia extends Model
{
    use HasFactory;
    protected $table = 'descargas_constancias';

    protected $fillable = [
        'documento_id',
        'alumno_user_id',
        'descargado_en',
    ];

    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }

    public function alumno()
    {
        return $this->belongsTo(User::class, 'alumno_user_id');
    }
}
