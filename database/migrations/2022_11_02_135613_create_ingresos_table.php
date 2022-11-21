<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_ingreso', 50);
            $table->string('detalle', 100);
            $table->date('fecha_ingreso');
            $table->double('monto', 8,2);
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('ingresos');
    }
};
