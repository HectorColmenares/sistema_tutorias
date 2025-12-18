<?php

namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;

class AlumnoPagesController extends Controller
{
    public function asistencia()
    {
        return view('alumno.asistencia');
    }

    public function constancia()
    {
        return view('alumno.constancia');
    }

    public function calificacion()
    {
        return view('alumno.calificacion');
    }

    public function tutorias()
    {
        return view('alumno.tutorias');
    }

    public function datos()
    {
        return view('alumno.datos');
    }
}
