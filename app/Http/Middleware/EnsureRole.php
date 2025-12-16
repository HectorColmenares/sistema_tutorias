<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /**
     * Uso:
     *   ->middleware('role:coordinador')
     *   ->middleware('role:tutor')
     *   ->middleware('role:alumno')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(401);
        }

        // Si el user tiene "activo" y está desactivado, lo cortamos
        if (property_exists($user, 'activo') && $user->activo === false) {
            abort(403, 'Usuario inactivo.');
        }

        // Normalizamos roles permitidos
        $roles = array_map(fn ($r) => strtolower(trim($r)), $roles);

        $userRole = strtolower((string) $user->rol);

        if (!in_array($userRole, $roles, true)) {
            abort(403);
        }

        return $next($request);
    }
}
