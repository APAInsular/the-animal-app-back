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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 45);
            $table->string('edad', 45);
            $table->text('historia');
            $table->foreignId('especie_id')->constrained();
            $table->foreignId('alimentacion_id')->constrained();
            $table->foreignId('cuidados_id')->constrained();
            $table->foreignId('necesidades_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
