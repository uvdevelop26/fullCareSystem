<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('turnos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_turnos', 45);
            $table->time('hora_entrada');
            $table->time('hora_salida');
            $table->unsignedBigInteger('empleado_id');

            $table->foreign('empleado_id')
                ->references('id')
                ->on('empleados')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('turnos');
    }
};
