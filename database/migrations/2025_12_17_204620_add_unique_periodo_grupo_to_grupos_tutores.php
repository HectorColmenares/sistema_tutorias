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
    Schema::table('grupos_tutores', function (Blueprint $table) {
        $table->unique(['periodo_id', 'grupo'], 'gt_periodo_grupo_unique');
    });
}

public function down(): void
{
    Schema::table('grupos_tutores', function (Blueprint $table) {
        $table->dropUnique('gt_periodo_grupo_unique');
    });
}

};
