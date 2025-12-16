<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoTutor extends Model
{
    use HasFactory;
     protected $table = 'grupos_tutores';
    protected $fillable = [
        'periodo_id',
        'grupo',
        'tutor_user_id',
    ];

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_user_id');
    }
}
