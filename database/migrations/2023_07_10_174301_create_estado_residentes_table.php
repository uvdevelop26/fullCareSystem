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
            $table->string('nombre_estado', 100);
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('estado_residentes');
    }
};
