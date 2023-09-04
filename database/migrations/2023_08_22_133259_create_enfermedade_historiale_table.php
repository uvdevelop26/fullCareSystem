<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('enfermedade_historiale', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('historiale_id');
            $table->unsignedBigInteger('enfermedade_id');

            $table->foreign('historiale_id')
                ->references('id')
                ->on('historiales')
                ->onDelete('cascade');
            $table->foreign('enfermedade_id')
                ->references('id')
                ->on('enfermedades')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('enfermedade_historiale');
    }
};
