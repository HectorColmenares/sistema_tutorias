<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\DashboardRedirectController;
use App\Http\Controllers\Coordinador\DashboardController as CoordinadorDashboardController;
use App\Http\Controllers\Tutor\DashboardController as TutorDashboardController;
use App\Http\Controllers\Alumno\DashboardController as AlumnoDashboardController;

Route::get('/', function () {
    return view('welcome');
});

//  /dashboard ahora REDIRIGE según el rol
Route::get('/dashboard', DashboardRedirectController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ Rutas por rol (dashboards mínimos)
Route::middleware(['auth', 'verified', 'role:coordinador'])
    ->prefix('coordinador')
    ->name('coordinador.')
    ->group(function () {
        Route::get('/dashboard', CoordinadorDashboardController::class)->name('dashboard');
    });

Route::middleware(['auth', 'verified', 'role:tutor'])
    ->prefix('tutor')
    ->name('tutor.')
    ->group(function () {
        Route::get('/dashboard', TutorDashboardController::class)->name('dashboard');
    });

Route::middleware(['auth', 'verified', 'role:alumno'])
    ->prefix('alumno')
    ->name('alumno.')
    ->group(function () {
        Route::get('/dashboard', AlumnoDashboardController::class)->name('dashboard');
    });

require __DIR__.'/auth.php';
