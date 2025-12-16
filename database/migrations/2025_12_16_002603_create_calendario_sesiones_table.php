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
        Schema::create('calendario_sesiones', function (Blueprint $table) {
    $table->id();
    $table->foreignId('periodo_id')->constrained('periodos')->cascadeOnDelete();
    $table->unsignedTinyInteger('numero_sesion');
    $table->date('fecha_programada');
    $table->date('fecha_reprogramada')->nullable();
    $table->string('motivo_reprogramacion', 255)->nullable();
    $table->foreignId('reprogramada_por_user_id')->nullable()->constrained('users')->nullOnDelete();
    $table->timestamps();

    $table->unique(['periodo_id', 'numero_sesion']);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendario_sesiones');
    }
};
