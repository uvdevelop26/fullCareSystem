<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('dias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_dias');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dias');
    }
};
