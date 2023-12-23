<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('estado_residentes', function (Blueprint $table) {
            $table->id();
            $table->boolean('nombre');
            $table->string('motivo_salida')->nullable();
            $table->date('fecha_salida')->nullable();
            $table->date('fecha_regreso')->nullable();

            $table->unsignedBigInteger('residente_id');

            $table->foreign('residente_id')
                ->references('id')
                ->on('residentes')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('estado_residentes');
    }
};
