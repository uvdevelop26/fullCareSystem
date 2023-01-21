<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historiales', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_historial');
            $table->string('observaciones');

            $table->unsignedBigInteger('residente_id');
            $table->unsignedBigInteger('caracteristica_id')->nullable();
            $table->unsignedBigInteger('enfermedade_id')->nullable();
            $table->unsignedBigInteger('incidencia_id')->nullable();

            $table->foreign('residente_id')
                ->references('id')
                ->on('residentes')
                ->onDelete('cascade');
            $table->foreign('caracteristica_id')
                ->references('id')
                ->on('caracteristicas')
                ->onDelete('set null');
            $table->foreign('enfermedade_id')
                ->references('id')
                ->on('enfermedades')
                ->onDelete('set null');
            $table->foreign('incidencia_id')
                ->references('id')
                ->on('incidencias')
                ->onDelete('set null');
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
        Schema::dropIfExists('historiales');
    }
};
