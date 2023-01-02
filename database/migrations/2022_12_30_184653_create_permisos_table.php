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
            $table->date('fecha_permiso');
            $table->string('justificacion');
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
