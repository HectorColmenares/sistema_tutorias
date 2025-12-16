<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\DashboardRedirectController;
use App\Http\Controllers\Coordinador\DashboardController as CoordinadorDashboardController;
use App\Http\Controllers\Tutor\DashboardController as TutorDashboardController;
use App\Http\Controllers\Alumno\DashboardController as AlumnoDashboardController;
use App\Http\Controllers\Coordinador\PeriodoController;
use App\Http\Controllers\Coordinador\AltasController;

Route::get('/', function () {
    return redirect()->route('login');
})->name('welcome');

// /dashboard ahora REDIRIGE según el rol
Route::get('/dashboard', DashboardRedirectController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ================= COORDINADOR =================
Route::middleware(['auth', 'verified', 'role:coordinador'])
    ->prefix('coordinador')
    ->name('coordinador.')
    ->group(function () {
        Route::get('altas', [AltasController::class, 'index'])->name('altas.index');

Route::get('altas/tutor/crear', [AltasController::class, 'createTutor'])->name('altas.tutor.create');
Route::post('altas/tutor', [AltasController::class, 'storeTutor'])->name('altas.tutor.store');

Route::get('altas/alumno/crear', [AltasController::class, 'createAlumno'])->name('altas.alumno.create');
Route::post('altas/alumno', [AltasController::class, 'storeAlumno'])->name('altas.alumno.store');

Route::get('altas/password', [AltasController::class, 'editPassword'])->name('altas.password.edit');
Route::patch('altas/password', [AltasController::class, 'updatePassword'])->name('altas.password.update');

        // Dashboard coordinador
        Route::get('/dashboard', CoordinadorDashboardController::class)->name('dashboard');

        // ====== PERIODOS ======
        Route::resource('periodos', PeriodoController::class)->except(['show']);

        Route::patch('periodos/{periodo}/activar', [PeriodoController::class, 'activar'])
            ->name('periodos.activar');
    });

// ================= TUTOR =================
Route::middleware(['auth', 'verified', 'role:tutor'])
    ->prefix('tutor')
    ->name('tutor.')
    ->group(function () {
        Route::get('/dashboard', TutorDashboardController::class)->name('dashboard');
    });

// ================= ALUMNO =================
Route::middleware(['auth', 'verified', 'role:alumno'])
    ->prefix('alumno')
    ->name('alumno.')
    ->group(function () {
        Route::get('/dashboard', AlumnoDashboardController::class)->name('dashboard');
    });

require __DIR__.'/auth.php';
