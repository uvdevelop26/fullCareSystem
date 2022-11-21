<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('pensiones', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 50);
            $table->string('nro_tarjeta', 30)->nullable();
            $table->string('titular', 50);
            $table->double('monto_mensual', 8,2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pensiones');
    }
};
