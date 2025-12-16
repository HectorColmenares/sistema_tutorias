<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asistencias', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tutoria_id')->constrained('tutorias')->cascadeOnDelete();
    $table->foreignId('alumno_user_id')->constrained('users')->restrictOnDelete();

    $table->enum('estado', ['pendiente','asistio','falto','permiso_aprobado','permiso_rechazado'])
          ->default('pendiente');

    $table->foreignId('confirmado_por_user_id')->nullable()->constrained('users')->nullOnDelete();
    $table->dateTime('confirmado_en')->nullable();
    $table->timestamps();

    $table->unique(['tutoria_id', 'alumno_user_id']);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
