<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('horario_medicamento_medicamento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medicamento_id');
            $table->unsignedBigInteger('horario_medicamento_id');

            $table->foreign('medicamento_id')
                ->references('id')
                ->on('medicamentos')
                ->onDelete('cascade');

            $table->foreign('horario_medicamento_id')
                ->references('id')
                ->on('horario_medicamento')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('horario_medicamento_medicamento');
    }
};
