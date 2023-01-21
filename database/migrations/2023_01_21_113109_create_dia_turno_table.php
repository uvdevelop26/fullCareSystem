<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('dia_turno', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('turno_id');
            $table->unsignedBigInteger('dia_id');

            $table->foreign('turno_id')
                ->references('id')
                ->on('turnos')
                ->onDelete('cascade');
            $table->foreign('dia_id')
                ->references('id')
                ->on('dias')
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
        Schema::dropIfExists('dia_turno');
    }
};
