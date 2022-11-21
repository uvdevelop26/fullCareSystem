<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_medicamentos', 50);
            $table->string('forma_suministro', 20);
            $table->string('cantidad_diaria', 20);
            $table->date('fecha_vencimiento');
            $table->integer('stock');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('medicamentos');
    }
};
