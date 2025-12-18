<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;

class TutorPagesController extends Controller
{
    public function documentos() { return view('tutor.documentos'); }
    public function calendarizacion() { return view('tutor.calendarizacion'); }
    public function tutorados() { return view('tutor.tutorados'); }
    public function calificacion() { return view('tutor.calificacion'); }
    public function tutorias() { return view('tutor.tutorias'); }
    public function entrevistas() { return view('tutor.entrevistas'); }
    public function asistencias() { return view('tutor.asistencias'); }
    public function constancias() { return view('tutor.constancias'); }
    public function datos() { return view('tutor.datos'); }
}
