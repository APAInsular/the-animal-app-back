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
            $table->string('nombre');
            // $table->integer('edad')->nullable()->default(0);
            $table->text('historia')->nullable();
            $table->foreignId('especie_id')->nullable()->constrained()->default(0);
            $table->foreignId('alimentacion_id')->nullable()->constrained()->default(0);
            $table->foreignId('cuidados_id')->nullable()->constrained()->default(0);
            $table->foreignId('necesidades_id')->nullable()->constrained()->default(0);
            $table->string('foto')->nullable();
            $table->date('fecha_esterilizacion')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->date('fecha_llegada')->nullable();
            $table->string('raza')->nullable();
            $table->string('tipo')->nullable();
            $table->string('microchip')->nullable();
            $table->boolean('esterilizado')->default(false);
            $table->boolean('zoocan')->default(false);
            $table->boolean('cartilla')->default(false);
            $table->date('desparasitacion')->nullable();
            $table->string('superpoder')->nullable();
            $table->text('descripcion')->nullable();
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
