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
        Schema::create('direccion_usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('calle', 100);
            $table->integer('numero');
            $table->string('ciudad', 45);
            $table->string('localidad', 45);
            $table->string('codigo_postal', 10);
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direccion_usuarios');
    }
};
