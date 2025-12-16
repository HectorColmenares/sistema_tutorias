<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sesiones_tutorias', function (Blueprint $table) {
            $table->id();

            // Si tu tabla de periodos se llama "periodos" y su PK es id:
            $table->foreignId('periodo_id')->constrained('periodos')->cascadeOnDelete();

            $table->unsignedTinyInteger('numero'); // 1..16
            $table->date('fecha')->nullable();
            $table->time('hora_inicio')->nullable();
            $table->time('hora_fin')->nullable();

            $table->string('titulo')->nullable();      // opcional
            $table->text('descripcion')->nullable();   // opcional

            $table->timestamps();

            $table->unique(['periodo_id', 'numero']); // evita duplicar sesion 1..16 en el mismo periodo
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sesiones_tutorias');
    }
};
