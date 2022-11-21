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
        Schema::create('pensione_residente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pensione_id');
            $table->unsignedBigInteger('residente_id');
            $table->foreign('pensione_id')
                ->references('id')
                ->on('pensiones')
                ->onDelete('cascade');
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
        Schema::dropIfExists('pensione_residente');
    }
};
