<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('familiares', function (Blueprint $table) {
            $table->id();
            $table->string('parentezco', 200);
            $table->string('email');
            $table->unsignedBigInteger('residente_id')->nullable();
            $table->unsignedBigInteger('persona_id');

            $table->foreign('residente_id')
                ->references('id')
                ->on('residentes')
                ->onDelete('set null');
            $table->foreign('persona_id')
                ->references('id')
                ->on('personas')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('familiares');
    }
};
