<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('ciudades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_ciudad', 100);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('ciudades');
    }
};
