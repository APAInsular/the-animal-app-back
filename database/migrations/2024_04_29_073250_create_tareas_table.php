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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 45);
            $table->text('descripcion');
            $table->boolean("SeRepite")->default(true);
            $table->date('fecha');
            $table->string('comentario', 100);
            $table->boolean("finalizada")->default(false);
            $table->string('url', 200)->nullable();
            $table->foreignId('animal_id')->constrained();
            $table->foreignId('voluntario_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
