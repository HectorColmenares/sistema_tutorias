<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('resas', function (Blueprint $table) {
            $table->id();

            // Base común
            $table->foreignId('periodo_id')->constrained('periodos')->cascadeOnDelete();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->enum('estado', ['borrador', 'final'])->default('borrador');
            $table->string('pdf_path')->nullable();
            $table->date('fecha_elaboracion')->nullable();

            // Campos mínimos RESA
            $table->string('nombre_tutor')->nullable();
            $table->string('carrera')->nullable();
            $table->integer('total_alumnos')->nullable();
            $table->text('descripcion_actividades')->nullable();
            $table->text('resultados')->nullable();
            $table->text('conclusiones')->nullable();

            $table->timestamps();

            $table->index(['periodo_id', 'created_by']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resas');
    }
};
