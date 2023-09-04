<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::table('medicamentos', function (Blueprint $table) {
            $table->unsignedBigInteger('presentacione_id');

            $table->foreign('presentacione_id')
                ->references('id')
                ->on('presentaciones')
                ->onDelete('cascade');
        });
    }

    
    public function down()
    {
        Schema::table('medicamentos', function (Blueprint $table) {
            $table->dropForeign(['presentacione_id']);
            $table->dropColumn('presentacione_id');
        });
    }
};
