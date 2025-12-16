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
        Schema::create('tutorias', function (Blueprint $table) {
    $table->id();
    $table->foreignId('periodo_id')->constrained('periodos')->cascadeOnDelete();
    $table->foreignId('tutor_user_id')->constrained('users')->restrictOnDelete();
    $table->foreignId('calendario_sesion_id')->nullable()->constrained('calendario_sesiones')->nullOnDelete();
    $table->date('fecha');
    $table->string('tema', 255);
    $table->char('qr_token', 36)->unique();
    $table->enum('estado', ['activa', 'cerrada'])->default('activa');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutorias');
    }
};
