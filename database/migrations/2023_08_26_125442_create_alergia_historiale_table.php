<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('alergia_historiale', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('historiale_id');
            $table->unsignedBigInteger('alergia_id');

            $table->foreign('historiale_id')
                ->references('id')
                ->on('historiales')
                ->onDelete('cascade');
            $table->foreign('alergia_id')
                ->references('id')
                ->on('alergias')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('alergia_historiale');
    }
};
