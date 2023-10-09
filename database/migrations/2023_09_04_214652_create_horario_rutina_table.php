<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('horario_rutina', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rutina_id');
            $table->unsignedBigInteger('horario_id');

            $table->foreign('rutina_id')
                ->references('id')
                ->on('rutinas')
                ->onDelete('cascade');
            $table->foreign('horario_id')
                ->references('id')
                ->on('horarios')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('horario_rutina');
    }
};
