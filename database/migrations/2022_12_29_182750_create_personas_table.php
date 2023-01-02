<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('ci_numero', 100)->nullable(); //familiares no necesita ci
            $table->date('fecha_nacimiento');
            $table->string('telefono', 30)->nullable(); //residentes pueden no tener telefono
            $table->smallInteger('edad');
            $table->string('sexo', 50);
            $table->string('direccion', 200);
            $table->unsignedBigInteger('ciudade_id')->nullable();

            $table->foreign('ciudade_id')
                ->references('id')
                ->on('ciudades')
                ->onDelete('set null');
                
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('personas');
    }
};
