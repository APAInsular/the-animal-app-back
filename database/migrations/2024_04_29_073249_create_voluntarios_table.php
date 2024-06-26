<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// made by Harkaitz

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('voluntarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 45);
            $table->string('apellido', 45);
            $table->string('email', 100);
            $table->date('disponibilidad');
            $table->text('idioma');
            $table->time('horario');
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('formacion_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voluntarios');
    }
};
