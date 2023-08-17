<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('duracion');
            $table->string('motivo')->nullable();
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
        Schema::dropIfExists('permisos');
    }
};
