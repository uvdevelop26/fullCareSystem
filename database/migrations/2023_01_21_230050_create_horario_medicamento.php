<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('horario_medicamento', function (Blueprint $table) {
            $table->id();
            $table->time('hora');
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('horario_medicamento');
    }
};
