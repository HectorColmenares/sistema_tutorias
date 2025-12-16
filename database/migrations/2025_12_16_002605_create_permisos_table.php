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
        Schema::create('permisos', function (Blueprint $table) {
    $table->id();
    $table->foreignId('asistencia_id')->unique()->constrained('asistencias')->cascadeOnDelete();
    $table->string('motivo', 180);
    $table->text('descripcion');
    $table->string('archivo_ruta', 255)->nullable();
    $table->enum('estado', ['pendiente','aprobado','rechazado'])->default('pendiente');
    $table->foreignId('decidido_por_user_id')->nullable()->constrained('users')->nullOnDelete();
    $table->dateTime('decidido_en')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permisos');
    }
};
