<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('familiars', function (Blueprint $table) {
            $table->id();
            $table->string('parentesco', 30);
            $table->string('email', 40);
            $table->unsignedBigInteger('persona_id');
            $table->unsignedBigInteger('residente_id');
            $table->foreign('persona_id')
                ->references('id')
                ->on('personas')
                ->onDelete('cascade');
            $table->foreign('residente_id')
                ->references('id')
                ->on('residentes')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('familiars');
    }
};
