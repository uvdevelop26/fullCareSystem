<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('sueldos', function (Blueprint $table) {
            $table->id();
            $table->string('categoria');
            $table->double('monto', 8, 2);
            $table->string('observacion', 50);
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('sueldos');
    }
};
