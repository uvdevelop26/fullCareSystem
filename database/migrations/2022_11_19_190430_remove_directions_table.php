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
        Schema::dropIfExists('directions');
    }

   
    public function down()
    {
        Schema::create('directions', function (Blueprint $table) {
            $table->id();
            $table->string('pais', 12);
            $table->string('ciudad', 20);
            $table->string('barrio', 40);   
            $table->timestamps();
        });
    }
};
