<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('control_rutina', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora')->nullable();
            $table->boolean('realizado');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('horario_rutina_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('horario_rutina_id')
                ->references('id')
                ->on('horario_rutina')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('control_rutina');
    }
};
