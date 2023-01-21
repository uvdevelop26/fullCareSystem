<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('enfermedades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_enfermedades');
            $table->string('tratamientos');
            $table->string('alimentacion');
            $table->string('recomendaciones')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('enfermedades');
    }
};
