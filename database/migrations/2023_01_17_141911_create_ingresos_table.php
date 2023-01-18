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
            $table->string('tipo', 100);
            $table->string('subtipo')->nullable();
            $table->string('detalle', 200)->nullable();
            $table->date('ingreso_fecha');
            $table->decimal('monto', 8,2);
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('ingresos');
    }
};
