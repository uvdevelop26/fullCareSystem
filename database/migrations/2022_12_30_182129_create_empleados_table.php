<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_ingreso');
            $table->string('email');
            $table->string('profesion', 200);
            $table->unsignedBigInteger('seccion_id')->nullable();
            $table->unsignedBigInteger('persona_id');

            $table->foreign('seccion_id')
                ->references('id')
                ->on('seccions')
                ->onDelete('set null');

            $table->foreign('persona_id')
                ->references('id')
                ->on('personas')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('empleados');
    }
};
