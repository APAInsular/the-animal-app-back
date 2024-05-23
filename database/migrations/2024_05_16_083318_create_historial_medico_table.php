<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// made by Lucas

class CreateHistorialMedicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_medico', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('animal_id');
            $table->date('fecha');
            $table->text('descripcion');
            $table->timestamps();

            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial_medico');
    }
}
