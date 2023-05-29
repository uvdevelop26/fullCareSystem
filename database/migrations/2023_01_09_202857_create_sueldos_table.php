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
        Schema::create('sueldos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->decimal('monto', 8, 2);
            $table->unsignedBigInteger('empleado_id');

            $table->foreign('empleado_id')
                ->references('id')
                ->on('empleados')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

  
    public function down()
    {
        Schema::dropIfExists('sueldos');
    }
};
