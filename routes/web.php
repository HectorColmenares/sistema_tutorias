<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\DashboardRedirectController;
use App\Http\Controllers\Coordinador\DashboardController as CoordinadorDashboardController;
use App\Http\Controllers\Tutor\DashboardController as TutorDashboardController;
use App\Http\Controllers\Alumno\DashboardController as AlumnoDashboardController;

use App\Http\Controllers\Coordinador\PeriodoController;
use App\Http\Controllers\Coordinador\AltasController;
use App\Http\Controllers\Coordinador\CalendarizacionController;
use App\Http\Controllers\Coordinador\GruposTutoresController;

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

        // Dashboard coordinador
        Route::get('/dashboard', CoordinadorDashboardController::class)->name('dashboard');

        // ====== ALTAS ======
        Route::get('altas', [AltasController::class, 'index'])->name('altas.index');

        Route::get('altas/tutor/crear', [AltasController::class, 'createTutor'])->name('altas.tutor.create');
        Route::post('altas/tutor', [AltasController::class, 'storeTutor'])->name('altas.tutor.store');

        Route::get('altas/alumno/crear', [AltasController::class, 'createAlumno'])->name('altas.alumno.create');
        Route::post('altas/alumno', [AltasController::class, 'storeAlumno'])->name('altas.alumno.store');

        Route::get('altas/password', [AltasController::class, 'editPassword'])->name('altas.password.edit');
        Route::patch('altas/password', [AltasController::class, 'updatePassword'])->name('altas.password.update');

        Route::post('altas/alumnos/importar', [AltasController::class, 'importAlumnos'])->name('altas.alumnos.import');
        Route::post('altas/tutores/importar', [AltasController::class, 'importTutores'])->name('altas.tutores.import');

        // ====== PERIODOS ======
        Route::resource('periodos', PeriodoController::class)->except(['show']);

        Route::patch('periodos/{periodo}/activar', [PeriodoController::class, 'activar'])
            ->name('periodos.activar');

        Route::patch('periodos/{periodo}/desactivar', [PeriodoController::class, 'desactivar'])
            ->name('periodos.desactivar');

        // ====== CALENDARIZACIÓN ======
        Route::prefix('calendarizacion')->name('calendarizacion.')->group(function () {
            Route::get('/', [CalendarizacionController::class, 'index'])->name('index');
            Route::post('/generar-16', [CalendarizacionController::class, 'generar16'])->name('generar16');

            // Guardar edición masiva por periodo
            Route::put('/periodo/{periodo}', [CalendarizacionController::class, 'updatePeriodo'])->name('updatePeriodo');

            // Eliminar sesión específica
            Route::delete('/sesion/{sesion}', [CalendarizacionController::class, 'destroy'])->name('destroy');
        });

        // ====== GRUPOS (asignación tutor->grupo) ======
        Route::get('grupos', [GruposTutoresController::class, 'index'])->name('grupos.index');
        Route::post('grupos', [GruposTutoresController::class, 'store'])->name('grupos.store');
        Route::get('grupos/{grupoTutor}', [GruposTutoresController::class, 'show'])->name('grupos.show');
        Route::delete('grupos/{grupoTutor}', [GruposTutoresController::class, 'destroy'])->name('grupos.destroy');
    });

// ================= TUTOR =================
Route::middleware(['auth', 'verified', 'role:tutor'])
    ->prefix('tutor')
    ->name('tutor.')
    ->group(function () {
        Route::get('/dashboard', TutorDashboardController::class)->name('dashboard');
    });

    use App\Http\Controllers\Tutor\TutorPagesController;

Route::middleware(['auth', 'verified', 'role:tutor'])
    ->prefix('tutor')
    ->name('tutor.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('tutor.dashboard');
        })->name('dashboard');

        Route::get('/documentos', [TutorPagesController::class, 'documentos'])->name('documentos');
        Route::get('/calendarizacion', [TutorPagesController::class, 'calendarizacion'])->name('calendarizacion');
        Route::get('/tutorias', [TutorPagesController::class, 'tutorias'])->name('tutorias');
        Route::get('/entrevistas', [TutorPagesController::class, 'entrevistas'])->name('entrevistas');
        Route::get('/asistencias', [TutorPagesController::class, 'asistencias'])->name('asistencias');
        Route::get('/constancias', [TutorPagesController::class, 'constancias'])->name('constancias');
        Route::get('/datos', [TutorPagesController::class, 'datos'])->name('datos');
        Route::get('/tutorados', [TutorPagesController::class, 'tutorados'])->name('tutorados');
        Route::get('/calificacion', [TutorPagesController::class, 'calificacion'])->name('calificacion');

    });


// ================= ALUMNO =================
Route::middleware(['auth', 'verified', 'role:alumno'])
    ->prefix('alumno')
    ->name('alumno.')
    ->group(function () {
        Route::get('/dashboard', AlumnoDashboardController::class)->name('dashboard');
    });
    use App\Http\Controllers\Alumno\AlumnoPagesController;

Route::middleware(['auth', 'verified', 'role:alumno'])
    ->prefix('alumno')
    ->name('alumno.')
    ->group(function () {

        Route::get('/dashboard', AlumnoDashboardController::class)->name('dashboard');

        Route::get('/asistencia', [AlumnoPagesController::class, 'asistencia'])->name('asistencia');
        Route::get('/constancia', [AlumnoPagesController::class, 'constancia'])->name('constancia');
        Route::get('/calificacion', [AlumnoPagesController::class, 'calificacion'])->name('calificacion');
        Route::get('/tutorias', [AlumnoPagesController::class, 'tutorias'])->name('tutorias');
        Route::get('/datos', [AlumnoPagesController::class, 'datos'])->name('datos');
    });


    

require __DIR__ . '/auth.php';
