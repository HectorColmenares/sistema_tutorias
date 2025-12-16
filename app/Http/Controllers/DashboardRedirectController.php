<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardRedirectController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $user = $request->user();

        return match ($user->rol) {
            'coordinador' => redirect()->route('coordinador.dashboard'),
            'tutor'       => redirect()->route('tutor.dashboard'),
            'alumno'      => redirect()->route('alumno.dashboard'),
            default       => abort(403, 'Rol no válido.'),
        };
    }
}
