<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('egresos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_egreso', 50);
            $table->string('subtipo', 50);
            $table->string('detalle', 100);
            $table->date('fecha_egreso');
            $table->double('monto', 8,2);
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('egresos');
    }
};
