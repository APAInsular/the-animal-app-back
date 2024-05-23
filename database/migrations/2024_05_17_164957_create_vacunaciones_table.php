<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// made by Lucas

class CreateVacunacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacunaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->date('fecha');
            $table->unsignedBigInteger('animal_id');
            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacunaciones');
    }
}
