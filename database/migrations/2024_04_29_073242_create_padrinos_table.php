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
        Schema::create('padrinos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 45);
            $table->string('apellido', 45);
            $table->string('email', 100);
            $table->string('telefono', 45);
            $table->foreignId('user_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('padrinos');
    }
};
