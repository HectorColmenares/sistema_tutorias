<?php

namespace App\Http\Controllers\Coordinador;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('coordinador.dashboard');
    }
}
