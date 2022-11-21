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
            $table->string('nombres', 50);
            $table->string('apellidos', 50);
            $table->string('ci_numero', 20);
            $table->date('fecha_nacimiento');
            $table->string('telefono', 25)->nullable();
            $table->tinyInteger('edad');
            $table->string('sexo', 15);
            $table->unsignedBigInteger('direction_id'); //eliminado
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('personas');
    }
};
