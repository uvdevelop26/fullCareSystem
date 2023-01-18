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
            $table->string('tipo', 100);
            $table->string('subtipo')->nullable();
            $table->string('detalle', 200)->nullable();
            $table->date('egreso_fecha');
            $table->decimal('monto', 8,2);
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('egresos');
    }
};
