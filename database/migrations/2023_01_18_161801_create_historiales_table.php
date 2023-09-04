<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historiales', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_registro');
            $table->string('diagnostico');
            $table->string('tratamiento');
            $table->string('observaciones')->nullable();
            $table->unsignedBigInteger('residente_id');
            $table->unsignedBigInteger('caracteristica_id');
          
            $table->foreign('residente_id')
                ->references('id')
                ->on('residentes')
                ->onDelete('cascade');
            $table->foreign('caracteristica_id')
                ->references('id')
                ->on('caracteristicas')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('historiales');
    }
};
