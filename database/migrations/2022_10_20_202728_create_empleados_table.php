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
            $table->string('email', 50);
            $table->string('foto', 500);
            $table->unsignedBigInteger('persona_id')->unique();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->unsignedBigInteger('sueldo_id')->nullable();
            $table->foreign('persona_id')
                ->references('id')
                ->on('personas')
                ->onDelete('cascade');
            $table->foreign('section_id')
                ->references('id')
                ->on('sections')
                ->onDelete('set null');
            $table->foreign('sueldo_id')
                ->references('id')
                ->on('sueldos')
                ->onDelete('set null');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('empleados');
    }
};
