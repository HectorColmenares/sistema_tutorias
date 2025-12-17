<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('informes', function (Blueprint $table) {
            $table->id();

            // Base común
            $table->foreignId('periodo_id')->constrained('periodos')->cascadeOnDelete();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->enum('estado', ['borrador', 'final'])->default('borrador');
            $table->string('pdf_path')->nullable();
            $table->date('fecha_elaboracion')->nullable();

            // Campos mínimos INFORME
            $table->string('nombre_tutor')->nullable();
            $table->string('grupo')->nullable();
            $table->integer('alumnos_atendidos')->nullable();
            $table->text('problematicas_detectadas')->nullable();
            $table->text('acciones_realizadas')->nullable();
            $table->text('recomendaciones')->nullable();

            $table->timestamps();

            $table->index(['periodo_id', 'created_by']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('informes');
    }
};
