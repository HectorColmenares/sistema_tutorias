<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reacs', function (Blueprint $table) {
            $table->id();

            // Base común
            $table->foreignId('periodo_id')->constrained('periodos')->cascadeOnDelete();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->enum('estado', ['borrador', 'final'])->default('borrador');
            $table->string('pdf_path')->nullable();
            $table->date('fecha_elaboracion')->nullable();

            // Campos mínimos REAC
            $table->string('nombre_tutor')->nullable();
            $table->string('grupo')->nullable();
            $table->text('objetivo')->nullable();
            $table->text('actividades_realizadas')->nullable();
            $table->text('observaciones')->nullable();

            $table->timestamps();

            // Opcional: para listar rápido por periodo
            $table->index(['periodo_id', 'created_by']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reacs');
    }
};
