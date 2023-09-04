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
            $table->string('nombre', 100);
            $table->string('descripcion', 200);
            $table->string('dosis');
            $table->string('indicaciones')->nullable();
            $table->string('efectos_secundarios')->nullable();
            $table->unsignedBigInteger('residente_id');

            $table->foreign('residente_id')
                ->references('id')
                ->on('residentes')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('medicamentos');
    }
};
