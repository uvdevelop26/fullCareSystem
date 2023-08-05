<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('dia_jornada', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jornada_id');
            $table->unsignedBigInteger('dia_id');

            $table->foreign('jornada_id')
                ->references('id')
                ->on('jornadas')
                ->onDelete('cascade');
            $table->foreign('dia_id')
                ->references('id')
                ->on('dias')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('dia_jornada');
    }
};
