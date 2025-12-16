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
        Schema::create('entrevistas', function (Blueprint $table) {
    $table->id();
    $table->foreignId('periodo_id')->constrained('periodos')->cascadeOnDelete();
    $table->foreignId('tutor_user_id')->constrained('users')->restrictOnDelete();
    $table->foreignId('alumno_user_id')->constrained('users')->restrictOnDelete();
    $table->json('respuestas_json');
    $table->text('observaciones')->nullable();
    $table->timestamps();

    $table->unique(['periodo_id', 'alumno_user_id']);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrevistas');
    }
};
