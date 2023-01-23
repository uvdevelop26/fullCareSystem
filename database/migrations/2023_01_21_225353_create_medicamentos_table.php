<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_medicamento', 100);
            $table->string('via_suministro', 100);
            $table->date('fecha_vencimiento');
            $table->string('dosis_cantidad')->nullable();
            $table->integer('stock');
            $table->unsignedBigInteger('residente_id');

            $table->foreign('residente_id')
                ->references('id')
                ->on('residentes')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicamentos');
    }
};
