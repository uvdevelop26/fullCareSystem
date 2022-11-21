<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_seccion', 30);
            $table->string('descripcion', 100);
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('sections');
    }
};
