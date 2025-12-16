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
        Schema::create('documentos', function (Blueprint $table) {
    $table->id();
    $table->foreignId('periodo_id')->constrained('periodos')->cascadeOnDelete();
    $table->enum('tipo', ['REAC','RESA','PAT','INFORME','CONSTANCIA']);
    $table->string('nombre_original', 255);
    $table->string('ruta_archivo', 255);

    $table->foreignId('subido_por_user_id')->constrained('users')->restrictOnDelete();
    $table->foreignId('tutor_user_id')->nullable()->constrained('users')->nullOnDelete();
    $table->foreignId('alumno_user_id')->nullable()->constrained('users')->nullOnDelete();

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
